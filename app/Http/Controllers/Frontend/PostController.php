<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function show(Post $post) {

        SEOMeta::setTitle($post->title);
        $recent_posts = Post::latest()->take(5)->get();

        $post_tags_by_cats = [];
        foreach($post->tags() as $post_tag){
            $post_tags_by_cats[$post_tag->category_id][] = $post_tag;
        }

        return view('/themes.jpn.posts.single', [
            'post' => $post,
            'post_tags' => $post_tags_by_cats,
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

    public function reply(Request $request)
    {
        return view('components.posts.comments.form', ['title' => 'Reply on comment', 'item_id' => $request->input('replyId'), 'type' => 'reply'])->render();
    }

    public function saveReply(Request $request)
    {
        $id = $request->input('itemId');
        $replyComments = $request->input('commentNewContent');

        // Get post comments list;
        $parent_comment = Comment::find($id);
        $post = Post::find($parent_comment->post_id);

        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->reply_id = $id;
        $comment->the_comment = $replyComments;
        $comment->post_id = $post->id;
        $comment->save();
        $response = 'Reply successfully added!';

        // Prepare comments view;
        $comments_view = view('components.posts.comments.post-comments', ['post' => $post])->render();


        return response()->json([
            'result' => $response,
            'comments' => $comments_view,
            'post_id' => $parent_comment->post_id
        ]);
    }

    public function saveComment(Request $request)
    {
        $id = $request->input('itemId');
        $comment_text = $request->input('commentNewContent');
        $user_id = Auth::id();
        $error = false;

        $exist = Comment::where('post_id', $id)
            ->where('user_id', $user_id)
            ->where('the_comment', $comment_text)
            ->first();

        if($exist) {
            $response = 'Same comment already exist';
            $error = true;
        } else {
            $comment = new Comment;
            $comment->user_id = $user_id;
            $comment->post_id = $id;
            $comment->the_comment = $comment_text;
            $comment->save();
            $response = 'Comment successfully added!';
        }

        // Get post comments list;
        $post = Post::find($id);

        // Prepare comments view;
        $comments_view = view('components.posts.comments.post-comments', ['post' => $post])->render();

        return response()->json([
            'error' => $error,
            'result' => $response,
            'comments' => $comments_view
        ]);
    }
}
