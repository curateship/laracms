<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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
    public function showProfile($user_id){
        if(Auth::guest() && $user_id == 'my'){
            return abort(404);
        }   elseif($user_id == 'my'){
            return redirect('/profiles/'.Auth::id());
        }

        $user = User::find($user_id);

        if($user == null){
            return abort(404);
        }

        $posts = Post::where('user_id', $user->id)
            ->where('status', 'published')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('themes.jpn.users.profile', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

   // Edit
    public function editProfile(){
        return view('themes.jpn.users.edit-profile', [
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
