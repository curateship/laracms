<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    public function show(Post $post) {

        $recent_posts = Post::latest()->take(5)->get();

        return view('/theme.default.posts.single', [
            'post' => $post,
            'recent_posts' => $recent_posts,
        ]);
    }

    public function addComment(Post $post)
    {
        $attributes = request()->validate([
            'the_comment' => 'required|min:10|max:1000'
        ]);

        $attributes['user_id'] = auth()->id();
        $comment = $post->comments()->create($attributes);

        return redirect('/post/' . $post->slug . '#comment_' . $comment->id)->with('success', 'Comment has been added.');
    }


}
