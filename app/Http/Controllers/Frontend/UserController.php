<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(){
        $users = User::orderBy('name')
            ->paginate(20);

        return view('theme.users.all', [
            'users' => $users
        ]);
    }

    public function showProfile(Request $request, $user_name){
        if(Auth::guest() && $user_name == 'my'){
            return abort(404);
        }   elseif($user_name == 'my'){
            return redirect('/user/'.Auth::user()->username);
        }

        $user = User::where('username', $user_name)
            ->first();

        if($user == null){
            return abort(404);
        }

        $posts = [];
        if($request->has('type')){
            if($request->input('type') == 'liked'){
                $posts = Post::leftJoin('likes', 'likes.post_id', '=', 'posts.id')
                    ->where('status', 'published')
                    ->where('likes.user_id', $user->id)
                    ->orderBy('likes.created_at', 'DESC')
                    ->paginate(10);
            }
        }   else{
            $posts = Post::where('user_id', $user->id)
                ->where('status', 'published')
                ->orderBy('created_at', 'DESC')
                ->paginate(10);
        }

        $followed = false;
        if(!Auth::guest()){
            // Checking of following;
            $exist_follow = Follow::where('user_id', Auth::id())
                ->where('follow_user_id', $user->id)
                ->first();

            $followed = $exist_follow != null;
        }

        return view('theme.users.profile', [
            'user' => $user,
            'followed' => $followed,
            'posts' => $posts,
            'followers' => $user->getFollowersList(),
            'following' => $user->getFollowingList()
        ]);
    }

   // Edit
    public function editProfile(){
        return view('theme.users.edit-profile', [
            'user' => Auth::user()
        ]);
    }

    // Update
    public function profileUpdate(Request $request, $id)
    {
        if(!Gate::allows('is-admin') && (Auth::id() != $id)){
            return abort(404);
        }

        $user = User::findOrFail($id);

        if($user == null){
            return abort(404);
        }

        // Email unique checking;
        $exist_user = User::where('email', $request->input('email'))
            ->first();
        if($exist_user != null && $exist_user->id != $id){
            return redirect()->route('profile.edit', $user)->with('danger', 'Email must be unique...');
        }

        // Username;
        $exist_user = User::where('username', $request->input('username'))
            ->first();
        if($exist_user != null && $exist_user->id != $id){
            return redirect()->route('profile.edit', $user)->with('danger', 'Username must be unique...');
        }

        $user->username = $request->input('username');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->bio = $request->has('bio') ? $request->input('bio') : null;

        // Remove old avatar (if it not default);
        if($request->has('avatar-thumbnail') && $user->thumbnail != $request->input('avatar-thumbnail')){
            // Remove old avatar;
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
            // Remove old cover;
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

            $avatar_medium = ( $request->has('cover-medium') && !empty($request->input('cover-medium')) )  ? $request->input('cover-medium') : NULL;
            $avatar_medium = str_replace(url('/storage'.config('images.users_storage_path')), '', $avatar_medium);

            $user->cover_original = $cover_original;
            $user->cover_thumbnail = $cover_thumbnail;
            $user->cover_medium = $avatar_medium;
        }

        $user->save();

        // If user want to change password - lest check it on valid;
        if($request->input('new-password') != ''){
            if($request->input('new-password') != $request->input('confirm-password')){
                return redirect()->route('profile.edit', $user)->with('danger', 'Passwords must be the same...');
            }

            if(!Hash::check($request->input('password'), $user->password)){
                return redirect()->route('profile.edit', $user)->with('danger', 'Current password is wrong...');
            }

            $user->setPasswordAttribute($request->input('new-password'));
            $user->save();
        }

        return redirect()->route('profile.edit', $user)->with('success', 'Your data has been updated.');
    }
}
