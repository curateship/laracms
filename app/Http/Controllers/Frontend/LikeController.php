<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    //
    public function like(Request $request){
        $post_id = $request->input('postId');

        // Getting current post likes;
        $post = Post::find($post_id);
        $likes = $post->likes();

        // If user not auth - return error;
        if(Auth::guest()){
            return [
                'error' => 419,
                'message' => 'You are not auth users',
                'likes' => $likes->count()
            ];
        }

        // Checking for exist like from auth user;
        $exist_auth_user_like = $post->userLiked();

        // If user already liked this post - remove it;
        if($exist_auth_user_like){
           Like::where('post_id', $post_id)
               ->where('user_id', Auth::id())
               ->delete();

            return [
                'error' => -1,
                'message' => 'Like successfully removed',
                'likes' => $likes->count()
            ];
        }   else{
            // If not - add like;
            $like = new Like();
            $like->post_id = $post_id;
            $like->user_id = Auth::id();
            $like->save();

            return [
                'error' => 0,
                'message' => 'Like successfully added',
                'likes' => $likes->count()
            ];
        }
    }
}
