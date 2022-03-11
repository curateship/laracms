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

        if(Gate::allows('is-admin')){
            return view('admin.users.index', ['users' => $users->paginate(10)]);
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
        $validedData = $request->validated();
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

        $original = ( $request->has('original') && !empty($request->input('original')) ) ? $request->input('original') : NULL;
        $original = str_replace(url('/storage'.config('images.users_storage_path')), '', $original);

        $thumbnail = ( $request->has('thumbnail') && !empty($request->input('thumbnail')) ) ? $request->input('thumbnail') : NULL;
        $thumbnail = str_replace(url('/storage'.config('images.users_storage_path')), '', $thumbnail);

        $medium = ( $request->has('medium') && !empty($request->input('medium')) )  ? $request->input('medium') : NULL;
        $medium = str_replace(url('/storage'.config('images.users_storage_path')), '', $medium);

        if($request->has('userId')){
            $post = Post::find($request->input('userId'));

            // If user was attached new image - we must remove old file;
            if($post->original != $original){
                $post->removePostImages('main');
            }

            // If body was update;
            if($post->body != $request->input('description')){
                $path = '/public'.config('images.users_storage_path');

                // Get current body images;
                $current_images = [];

                $body_array = json_decode($post->body, true);
                foreach($body_array['blocks'] as $block){
                    if($block['type'] == 'image'){
                        $url_array = explode('/', $block['data']['file']['url']);
                        $current_images[] = Arr::last($url_array);
                    }
                }

                // New body images;
                $new_images = [];
                $body_array = json_decode($request->input('description'), true);
                foreach($body_array['blocks'] as $block){
                    if($block['type'] == 'image'){
                        $url_array = explode('/', $block['data']['file']['url']);
                        $new_images[] = Arr::last($url_array);
                    }
                }

                // If we do not have old image in new list - delete this file;
                foreach($current_images as $image){
                    if(!in_array($image, $new_images)){
                        Storage::delete($path.'/original/'.$image);
                        Storage::delete($path.'/medium/'.$image);
                        Storage::delete($path.'/thumbnail/'.$image);
                    }
                }
            }

        }   else{
            $post = new Post();
            $post->user_id = Auth::id();
        }

        $user->original = $original;
        $user->thumbnail = $thumbnail;
        $user->medium = $medium;
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
        $ids = explode(',', $ids);

        foreach($ids as $id){
            // Updating all user posts;
            Post::where('user_id', $id)
                ->update([
                    'user_id' => null
                ]);

            // Updating all user comments;
            Comment::where('user_id', $id)
                ->update([
                    'user_id' => null
                ]);

            // Remove user avatar if it not default;


            // And then - remove the user;
            User::destroy($id);
        }

        if(count($ids) > 1){
            $request->session()->flash('success', 'You have deleted all selected users');
        }   else{
            $request->session()->flash('success', 'You have deleted the user');
        }
    }

    // Update
    public function update(Request $request, $id)
    {
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

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Remove old avatar (if it not default);
        if($request->has('thumbnail') && $user->thumbnail != $request->input('thumbnail')){
            // Remove old avatar (if it not default);
            if($user->thumbnail != ''){
                $url_array = explode('/', $user->thumbnail);
                $image = Arr::last($url_array);

                $path = '/public'.config('images.users_storage_path');
                Storage::delete($path.'/original/'.$image);
                Storage::delete($path.'/medium/'.$image);
                Storage::delete($path.'/thumbnail/'.$image);
            }

            $original = ( $request->has('original') && !empty($request->input('original')) ) ? $request->input('original') : NULL;
            $original = str_replace(url('/storage'.config('images.users_storage_path')), '', $original);

            $thumbnail = ( $request->has('thumbnail') && !empty($request->input('thumbnail')) ) ? $request->input('thumbnail') : NULL;
            $thumbnail = str_replace(url('/storage'.config('images.users_storage_path')), '', $thumbnail);

            $medium = ( $request->has('medium') && !empty($request->input('medium')) )  ? $request->input('medium') : NULL;
            $medium = str_replace(url('/storage'.config('images.users_storage_path')), '', $medium);

            $user->original = $original;
            $user->thumbnail = $thumbnail;
            $user->medium = $medium;
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
}
