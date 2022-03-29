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
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function show(Post $post) {

        SEOMeta::setTitle($post->title);
        $recent_posts = Post::latest()->take(5)->get();

        $post_tags_by_cats = [];
        foreach($post->tags() as $post_tag){
            $post_tags_by_cats[$post_tag->category_id][] = $post_tag;
        }

        if($post->type == 'image'){
            $content = '<img class="radius-lg" alt="thumbnail" src="'.'/storage'.config('images.posts_storage_path').$post->medium.'">';
        }   else{
            $video = DB::table('posts_videos')
                ->where('post_id', $post->id)
                ->first();

            // Render video player;
            $content = view('admin.posts.script-video-js-player', [
                'poster' => '/storage'.config('images.posts_storage_path').$post->medium,
                'video_mp4' => '/storage'.config('images.videos_storage_path').$video->medium,
                'video_webm' => '/storage'.config('images.videos_storage_path').$video->medium,
                'player_width' => config('images.player_size_original.width'),
                'player_height' => config('images.player_size_original.height'),
                'auto_width' => true
            ])->render();
        }

        return view('/themes.jpn.posts.single', [
            'post' => $post,
            'content' => $content,
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

        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->reply_id = $id;
        $comment->the_comment = $replyComments;
        $comment->post_id = $parent_comment->post_id;
        $comment->save();

        // First reply or not?
        $first_comment = false;
        if(Comment::where('reply_id', $id)->count() == 1){
            // First;
            $comments_view = view('components.posts.comments.reply-box', [
                'comment' => $parent_comment,
                'add_reply_list' => true,
                'reply_list' => $parent_comment->replies(false, $comment->id + 1),
                'last_comment_id' => $comment->id
            ])->render();
            $first_comment = true;
        }   else{
            // Not first;
            // Prepare comments view;
            $comments_view = view('components.posts.comments.reply-list', [
                'comment' => $parent_comment,
                'reply_list' => $parent_comment->replies(false, $comment->id + 1),
                'last_comment_id' => $comment->id
            ])->render();
        }

        return response()->json([
            'result' => 'Reply successfully added!',
            'comments' => $comments_view,
            'post_id' => $parent_comment->post_id,
            'total_replies' => $parent_comment->replies(true),
            'first_comment' => $first_comment
        ]);
    }

    public function getReply(Request $request){
        $parent_comment = Comment::find($request->input('commentId'));
        $last_comment_id = $request->has('lastCommentId') ? $request->input('lastCommentId') : 0;

        return view('components.posts.comments.reply-list', [
            'comment' => $parent_comment,
            'reply_list' => $parent_comment->replies(false, $last_comment_id),
            'last_comment_id' => $last_comment_id
        ])->render();
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

        // Get post comments list;
        $post = Post::find($id);

        if($exist) {
            $response = 'Same comment already exist';
            $error = true;

            // Prepare comments view;
            $comments_view = view('components.posts.comments.post-comments', [
                'last_comment_id' => 0,
                'comments' => $post->commentsList(0),
                'post' => $post
            ])->render();
        } else {
            $comment = new Comment;
            $comment->user_id = $user_id;
            $comment->post_id = $id;
            $comment->the_comment = $comment_text;
            $comment->save();
            $response = 'Comment successfully added!';

            // Prepare comments view;
            $comments_view = view('components.posts.comments.post-comments', [
                'last_comment_id' => $comment->id,
                'comments' => $post->commentsList($comment->id + 1),
                'post' => $post
            ])->render();
        }

        return response()->json([
            'error' => $error,
            'result' => $response,
            'comments' => $comments_view
        ]);
    }

    public function getPostComments($post_id, $last_comment_id){
        $post = Post::find($post_id);

        return view('components.posts.comments.post-comments', [
            'post' => $post,
            'last_comment_id' => $last_comment_id,
            'comments' => $post->commentsList($last_comment_id)
        ])->render();
    }
}
