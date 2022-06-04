<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Follow;
use App\Models\Notification;
use App\Models\Post;

use App\Models\Tag;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index(Request $request)
    {

        SEOMeta::setTitle(config('seotools.static_titles.'.get_called_class().'.'.__FUNCTION__));
        if($request->has('sortBy') && $request->input('sortBy') !== 'role'){
            $posts = Post::orderBy($request->input('sortBy'), $request->input('sortDesc'));
        }   else{
            $posts = Post::orderBy('created_at', 'DESC')->whereNotNull('user_id');
        }

        $status = 'All';
        if($request->has('status') && $request->input('status') != 'All'){
            $posts = $posts->where('status', strtolower($request->input('status')));
            $status = ucfirst($request->input('status'));
        }

        $posts = $posts->where('user_id', Auth::id());

        return view('admin.posts.index', [
            'posts' => $posts->paginate(10),
            'status' => $status
        ]);
    }

    // Create
    public function create()
    {
        return view('admin.posts.create', [
            'categories' => Category::pluck('name', 'id')
        ]);
    }

    // Destroy
    public function destroy(string $ids, Request $request)
    {
        $ids = explode(',', $ids);

        foreach($ids as $id){
            // Checking author;
            $post = Post::find($id);
            if($post->user_id != Auth::id()){
                continue;
            }

            // Remove tags links;
            DB::table('post_tag')
                ->where('post_id', $id)
                ->delete();

            // Remove all reply comments;
            Comment::where('post_id', $id)
                ->whereNotNull('reply_id')
                ->delete();

            // Remove all comment;
            Comment::where('post_id', $id)
                ->whereNull('reply_id')
                ->delete();

            // Remove all video links;
            DB::table('posts_videos')
                ->where('post_id', $id)
                ->delete();

            // remove all views;
            DB::table('posts_views')
                ->where('post_id', $id)
                ->delete();

            // Remove post images;
            $post = Post::find($id);
            $post->removePostImages('main');
            $post->removePostImages('body');

            // And then - remove the post;
            Post::destroy($id);
        }

        if(count($ids) > 1){
            $request->session()->flash('success', 'You have deleted all selected posts');
        }   else{
            $request->session()->flash('success', 'You have deleted the post');
        }
    }

    public function show(Request $request, Post $post) {
        // Only author or author can preview posts in draft;
        if($post->status == 'draft'){
            if(!Gate::allows('is-admin') && (!Auth::guest() && Auth::id() != $post->user_id)){
                return abort(404);
            }
        }

        // SEO Title
        SEOMeta::setTitle($post->title);
        SEOMeta::setDescription($post->excerpt);

        $post_tags_by_cats = [];
        foreach($post->tags() as $post_tag){
            $post_tags_by_cats[$post_tag->category_id][] = $post_tag;
        }

        $content = $post->prepareContent('radius-lg image-zoom__preview js-image-zoom__preview');

        $post->addViewHistory($request->ip(), $request->userAgent());

        $followed = false;
        if(!Auth::guest()){
            // Checking of following;
            $exist_follow = Follow::where('user_id', Auth::id())
                ->where('follow_user_id', $post->user_id)
                ->first();

            $followed = $exist_follow != null;
        }

        $post->author = $post->author();

        return view('/theme.posts.types.'.$post->type, [
            'followed' => $followed,
            'post' => $post,
            'content' => $content,
            'post_tags' => $post_tags_by_cats,
            'recent_posts' => $post->getRecentList(['title', 'tags']),
            'likes_count' => $post->likes()->count(),
            'user_liked' => $post->userLiked()
        ]);
    }

    // Comment
    public function addComment(Post $post)
    {
        $attributes = request()->validate([
            'the_comment' => 'required|min:10|max:1000'
        ]);

        $attributes['user_id'] = auth()->id();
        $comment = $post->comments()->create($attributes);

        return redirect('/post/' . $post->slug . '#comment_' . $comment->id)->with('success', 'Comment has been added.');
    }

    // Reply
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

        $post = Post::find($parent_comment->post_id);

        return response()->json([
            'result' => 'Reply successfully added!',
            'comments' => $comments_view,
            'post_id' => $parent_comment->post_id,
            'total_replies' => $parent_comment->replies(true),
            'first_comment' => $first_comment,
            'commentsCount' => $post->commentsCount()
        ]);
    }

    // Get replies
    public function getReply(Request $request){
        $parent_comment = Comment::find($request->input('commentId'));
        $last_comment_id = $request->has('lastCommentId') ? $request->input('lastCommentId') : 0;

        return view('components.posts.comments.reply-list', [
            'comment' => $parent_comment,
            'reply_list' => $parent_comment->replies(false, $last_comment_id),
            'last_comment_id' => $last_comment_id
        ])->render();
    }

    // Save Comment
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

            $author = $post->author();

            if($user_id != $author->id){
                Notification::send($author->id, $user_id, Auth::user()->name, 'Commented on your post: '.$post->title, '/post/'.$post->slug, $post->id);
            }

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
            'comments' => $comments_view,
            'commentsCount' => $post->commentsCount()
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

    // Post Search
    public function postSearch(Request $request, $search_request){
        $search_like = str_replace(' ', '%', $search_request);

        // Search by tags;
        $tags = Tag::where('name', 'like', '%'.$search_like.'%')
            ->get();

        $tags_ids = [];
        foreach($tags as $tag){
            $tags_ids[] = $tag->id;
        }

        $posts_by_tag = DB::table('post_tag')
            ->whereIn('tag_id', $tags_ids)
            ->get();

        $posts_ids = [];
        foreach($posts_by_tag as $post_link){
            $posts_ids[] = $post_link->post_id;
        }


        // Search by titles or body and tags (by post id);
        $by_title_and_body = Post::where('status', 'published')
            ->where(function($query) use($search_like, $posts_ids){
                $query->where('title', 'like', '%'.$search_like.'%')
                    ->orWhere('body', 'like', '%'.$search_like.'%')
                    ->orWhereIn('id', $posts_ids);
            });

        $count = $by_title_and_body->count();
        $by_title_and_body = $by_title_and_body->paginate(10);

        session([
            'search' => $search_request
        ]);

        // SEO title
        SEOMeta::setTitle($search_request);
        return view('theme.posts.search-result', [
            'search' => $search_request,
            'total' => $count,
            'posts' => $by_title_and_body
        ]);
    }

    // Most liked posts;
    public function mostLiked(){
        $posts = Post::whereNotNull('post_id')
            ->leftJoin(DB::raw('(select post_id, count(*) as likes_count from likes group by post_id) as likes'), 'likes.post_id', '=', 'posts.id')
            ->orderBy('likes_count', 'desc')
            ->select('posts.*')
            ->paginate(20);

        return view('theme.posts.most-liked', [
            'posts' => $posts
        ]);
    }

    public function move(Request $request){
        $posts_array = explode(',', $request->input('list'));

        Post::whereIn('id', $posts_array)
            ->where('user_id', Auth::id())
            ->update([
                'updated_at' => now(),
                'status' => $request->input('direction')
            ]);
    }

    // Infinite Masonry
    public function ajaxShowPosts($page_num){
        $perpage = 20;
        $offset = ($page_num - 1) * $perpage;

        $posts = Post::where('status', 'published')
            ->offset($offset)
            ->limit($perpage)
            ->get();

        $posts_count = Post::where([
            'status' => 'published'
        ])->count();

        $data['total'] = $posts_count;
        $data['posts'] = $posts;
        $data['api_route'] = 'posts';
        $data['nextpage'] = ($posts_count - $offset - $perpage) > 0 ? ($page_num + 1) : 0;

        if(count($posts) == 0){
            abort(204);
        }

        return view('components.posts.lists.infinite-masonry.item', $data)->render();
    }

    // Infinite Posts for Home
    public function ajaxInfiniteShowPosts(Request $request, $page_num){
        $perpage = 3;
        $offset = ($page_num - 1) * $perpage;

        $posts = Post::where('status', 'published')
            ->select('posts.*')
            ->orderBy('created_at', 'DESC')
            ->offset($offset)
            ->limit($perpage);

        // Filter;
        if($request->has('type')){
            switch($request->input('type')){
                // Get users following list;
                case 'followings':
                    $posts = $posts->leftJoin('follows', 'follows.follow_user_id', '=', 'posts.user_id')
                        ->where('follows.user_id', Auth::id());
                    break;

                // All or nothing;
                default:
                case 'all':
                    // Nothing;
            }
        }

        $posts = $posts->get();

        $posts_count = Post::where([
            'status' => 'published'
        ])->count();

        foreach($posts as $post){
            if(Auth::guest()){
                $post->user_liked = false;
            }   else{
                $post->user_liked = $post->userLiked();
            }
        }

        // Preparing posts content;
        foreach($posts as $post){
            $post_tags_by_cats = [];
            foreach($post->tags() as $post_tag){
                $post_tags_by_cats[$post_tag->category_id][] = $post_tag;
            }

            $post->tags = $post_tags_by_cats;
            $post->content = $post->prepareContent('block width-100% height-100% object-cover image-zoom__preview js-image-zoom__preview');
        }

        $data['total'] = $posts_count;
        $data['posts'] = $posts;
        $data['api_route'] = 'posts';
        $data['nextpage'] = ($posts_count - $offset - $perpage) > 0 ? ($page_num + 1) : 0;

        if(count($posts) == 0){
            abort(204);
        }

        return view('components.posts.lists.infinite-posts.item', $data)->render();
    }
}
