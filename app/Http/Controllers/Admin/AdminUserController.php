<?php

namespace App\Http\Controllers\Admin;

// Others
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;

// Supports
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

// Models
use App\Models\Post;
use App\Models\User;
use App\Models\Role;

class AdminUserController extends Controller
{
    // Index
    public function index(Request $request)
    {
        SEOMeta::setTitle(config('seotools.static_titles.'.get_called_class().'.'.__FUNCTION__));

        if($request->has('sortBy') && $request->input('sortBy') !== 'role'){
            $users = User::orderBy($request->input('sortBy'), $request->input('sortDesc'));
        }   else{
            $users = User::orderBy('created_at', 'DESC');
        }

        if(Gate::denies('logged-in')){
            dd('no access allowed');
        }

        $users = $users->leftJoin(DB::raw("(select user_id, count(*) as posts_count from posts group by user_id) as posts"), 'posts.user_id', '=', 'users.id')
            ->leftJoin(DB::raw("(select user_id, count(*) as comments_count from comments group by user_id) as comments"), 'comments.user_id', '=', 'users.id');

        if($request->has('status') && $request->input('status') != 'All'){
            $users = $users->where('status', strtolower($request->input('status')));
            $status = ucfirst($request->input('status'));
        }

        $status = 'All';
        if($request->has('search') && $request->input('search') != ''){
            $search_input = str_replace(' ', '%', $request->input('search'));
            $users = $users->where('name', 'like', '%'.$search_input.'%');
        }

        if(Gate::allows('is-admin')){
            return view('admin.users.index', [
                'counters' => User::getCounters(),
                'users' => $users->paginate(10),
                'status' => $status
            ]);
        }

        dd('You need to be Admin');

    }

    // Create
    public function create()
    {
        return view('admin.users.create', ['roles' => Role::all()]);
    }

    // Store
    public function store(StoreUserRequest $request)
    {
        $request->validated();

        $user = User::create($request->except(['_token', 'roles']));
        $request->session()->flash('success', 'You have created the user');

        if($request->has('roles') && count($request->input('roles')) > 0){
            $roles = [];
            foreach($request->input('roles') as $role_id){
                $roles[] = [
                    'role_id' => $role_id
                ];
            }
            if(count($roles) > 0){
                $user->roles()->sync($roles);
            }
        }

        $avatar_original = ( $request->has('avatar-original') && !empty($request->input('avatar-original')) ) ? $request->input('avatar-original') : NULL;
        $avatar_original = str_replace(url('/storage'.config('images.users_storage_path')), '', $avatar_original);

        $avatar_thumbnail = ( $request->has('avatar-thumbnail') && !empty($request->input('avatar-thumbnail')) ) ? $request->input('avatar-thumbnail') : NULL;
        $avatar_thumbnail = str_replace(url('/storage'.config('images.users_storage_path')), '', $avatar_thumbnail);

        $avatar_medium = ( $request->has('avatar-medium') && !empty($request->input('avatar-medium')) )  ? $request->input('avatar-medium') : NULL;
        $avatar_medium = str_replace(url('/storage'.config('images.users_storage_path')), '', $avatar_medium);

        $cover_original = ( $request->has('cover-original') && !empty($request->input('cover-original')) ) ? $request->input('cover-original') : NULL;
        $cover_original = str_replace(url('/storage'.config('images.users_storage_path')), '', $cover_original);

        $cover_thumbnail = ( $request->has('cover-thumbnail') && !empty($request->input('cover-thumbnail')) ) ? $request->input('cover-thumbnail') : NULL;
        $cover_thumbnail = str_replace(url('/storage'.config('images.users_storage_path')), '', $cover_thumbnail);

        $cover_medium = ( $request->has('cover-medium') && !empty($request->input('cover-medium')) )  ? $request->input('cover-medium') : NULL;
        $cover_medium = str_replace(url('/storage'.config('images.users_storage_path')), '', $cover_medium);

        if($request->has('userId')){
            $user = User::find($request->input('userId'));

            // If user was attached new image - we must remove old file;
            // Avatar;
            if($user->original != $avatar_original){
                $url_array = explode('/', $user->original);
                $image = Arr::last($url_array);

                $path = '/public'.config('images.users_storage_path');
                Storage::delete($path.'/original/'.$image);
                Storage::delete($path.'/medium/'.$image);
                Storage::delete($path.'/thumbnail/'.$image);
            }

            // Cover
            if($user->cover_original != $cover_original){
                $url_array = explode('/', $user->cover_original);
                $image = Arr::last($url_array);

                $path = '/public'.config('images.users_storage_path');
                Storage::delete($path.'/original/'.$image);
                Storage::delete($path.'/medium/'.$image);
                Storage::delete($path.'/thumbnail/'.$image);
            }
        }

        $user->original = $avatar_original;
        $user->thumbnail = $avatar_thumbnail;
        $user->medium = $avatar_medium;
        $user->cover_original = $cover_original;
        $user->cover_thumbnail = $cover_thumbnail;
        $user->cover_medium = $cover_medium;
        $user->save();

        return redirect(route('admin.users.index'));
    }

    // Upload
    public function upload(Request $request){
        $path = '/public'.config('images.users_storage_path');
        $mime_type = $request->file('file')->getMimeType();
        $media_path = storage_path() . "/app";
        $media = [
            'original', 'medium', 'thumbnail'
        ];

        foreach($media as $key => $type){
            File::ensureDirectoryExists($media_path . '/public/users/'.$type);
            $media[$type] = config("images.$type");
            unset($media[$key]);
        }
        unset($media['original']);

        // Save original media file in file system;
        $original = request()->file('file')->getClientOriginalName();
        $thumbnail_medium_name = Str::random(27) . '.' . Arr::last(explode('.', $original));

        $original = request()->file('file')->storeAs($path."/original", $thumbnail_medium_name);

        foreach($media as $type_name => $type){
            if ($mime_type == 'image/gif') {
                /* GIF */
                $thumbnail_medium = new Imagick($media_path.'/'.$original);
                $thumbnail_medium = $thumbnail_medium->coalesceImages();
                do {
                    $thumbnail_medium->resizeImage( $type['width'], $type['height'], Imagick::FILTER_BOX, 1, true );
                } while ( $thumbnail_medium->nextImage());

                $thumbnail_medium = $thumbnail_medium->deconstructImages();

                $thumbnail_medium->writeImages($media_path . "/public/users/$type_name/" . $thumbnail_medium_name, true);
            }   else{
                /* Other Image types */
                $thumbnail_medium = Image::make(request()->file('file'));
                $thumbnail_medium->resize($type['width'], $type['height'], function($constraint){
                    $constraint->aspectRatio();
                });


                $thumbnail_medium->save($media_path . "/public/users/$type_name/" . $thumbnail_medium_name);
            }

            $media[$type_name]['path'] = $media_path . "/public/users/$type_name/" . $thumbnail_medium_name;
        }

        foreach($media as $key => $item){
            $media[$key]['path'] = url('/').Storage::url(str_replace($media_path.'/', '', $item['path']));
            unset($media[$key]['width']);
            unset($media[$key]['height']);
        }

        $media['original']['path'] = url('/').Storage::url($original);

        return $media;
    }

    // Edit
    public function edit($id)
    {
        return view('admin.users.edit',
         [
             'roles' => Role::all(),
             'user' => User::find($id)
            ]);
    }

    // Destroy
    public function destroy(string $ids, Request $request)
    {
        if($request->input('type') == 'clean-trash'){
            $users = User::where('status', 'trash')
                ->get();

            foreach($users as $user){
                $user->dropWithContent();
            }

            $request->session()->flash('success', 'Trash successfully cleaned');
            return;
        }

        $ids = explode(',', $ids);
        $action_message = '';

        foreach($ids as $id){
            $user = User::find($id);

            switch($request->input('type')){
                case 'delete':
                    $user->dropWithContent();
                    $action_message = 'deleted';
                    break;
                case 'trash':
                    $user->status = 'trash';
                    $user->save();
                    $action_message = 'moved to trash';
                    break;
                case 'suspended':
                    $user->status = 'suspended';
                    $user->save();
                    $action_message = 'suspended';
                    break;
            }
        }

        if(count($ids) > 1){
            $request->session()->flash('success', 'You have '.$action_message.' all selected users');
        }   else{
            $request->session()->flash('success', 'You have '.$action_message.' the user');
        }
    }

    // Update
    public function update(Request $request, $id)
    {
        if(!Gate::allows('is-admin') && (Auth::id() != $id)){
            return abort(404);
        }

        $user = User::findOrFail($id);

        if($user == null){
            return redirect()->route('admin.users.edit', $user)->with('danger', 'Undefined user...');
        }

        // Email unique checking;
        $exist_user = User::where('email', $request->input('email'))
            ->first();
        if($exist_user != null && $exist_user->id != $id){
            return redirect()->route('admin.users.edit', $user)->with('danger', 'Email must be unique...');
        }

        $user->username = $request->input('username');
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Remove old avatar (if it not default);
        if($request->has('avatar-thumbnail') && $user->thumbnail != $request->input('avatar-thumbnail')){
            // Remove old avatar (if it not default);
            if($user->thumbnail != ''){
                $url_array = explode('/', $user->thumbnail);
                $image = Arr::last($url_array);

                $path = '/public'.config('images.users_storage_path');
                Storage::delete($path.'/original/'.$image);
                Storage::delete($path.'/medium/'.$image);
                Storage::delete($path.'/thumbnail/'.$image);
            }

            $avatar_original = ( $request->has('avatar-original') && !empty($request->input('avatar-original')) ) ? $request->input('avatar-original') : NULL;
            $avatar_original = str_replace(url('/storage'.config('images.users_storage_path')), '', $avatar_original);

            $avatar_thumbnail = ( $request->has('avatar-thumbnail') && !empty($request->input('avatar-thumbnail')) ) ? $request->input('avatar-thumbnail') : NULL;
            $avatar_thumbnail = str_replace(url('/storage'.config('images.users_storage_path')), '', $avatar_thumbnail);

            $avatar_medium = ( $request->has('avatar-medium') && !empty($request->input('avatar-medium')) )  ? $request->input('avatar-medium') : NULL;
            $avatar_medium = str_replace(url('/storage'.config('images.users_storage_path')), '', $avatar_medium);

            $user->original = $avatar_original;
            $user->thumbnail = $avatar_thumbnail;
            $user->medium = $avatar_medium;
        }

        if($request->has('cover-thumbnail') && $user->cover_thumbnail != $request->input('cover-thumbnail')){
            // Remove old avatar (if it not default);
            if($user->cover_thumbnail != ''){
                $url_array = explode('/', $user->cover_thumbnail);
                $image = Arr::last($url_array);

                $path = '/public'.config('images.users_storage_path');
                Storage::delete($path.'/original/'.$image);
                Storage::delete($path.'/medium/'.$image);
                Storage::delete($path.'/thumbnail/'.$image);
            }

            $cover_original = ( $request->has('cover-original') && !empty($request->input('cover-original')) ) ? $request->input('cover-original') : NULL;
            $cover_original = str_replace(url('/storage'.config('images.users_storage_path')), '', $cover_original);

            $cover_thumbnail = ( $request->has('cover-thumbnail') && !empty($request->input('cover-thumbnail')) ) ? $request->input('cover-thumbnail') : NULL;
            $cover_thumbnail = str_replace(url('/storage'.config('images.users_storage_path')), '', $cover_thumbnail);

            $cover_medium = ( $request->has('cover-medium') && !empty($request->input('cover-medium')) )  ? $request->input('cover-medium') : NULL;
            $cover_medium = str_replace(url('/storage'.config('images.users_storage_path')), '', $cover_medium);

            $user->cover_original = $cover_original;
            $user->cover_thumbnail = $cover_thumbnail;
            $user->cover_medium = $cover_medium;
        }

        $user->save();

        // Updating all data was get;
        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.edit', $user)->with('success', 'User has been updated.');
    }

    // Theme Switcher
    public function saveTheme(Request $request){
        $user = User::find(Auth::id());
        $user->theme = $request->input('theme');
        $user->save();
    }

    public function restoreFromTrash(Request $request){
        if(Gate::allows('is-admin')){
            $user = User::find($request->input('userId'));
            $user->status = 'active';
            $user->save();

            return [
                'status' => 200
            ];
        }
    }
}
