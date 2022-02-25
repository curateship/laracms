<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        // view all tags in the blog
    }

    public function show(Tag $tag)
    {
        $recent_posts = Post::latest()->take(5)->get();
        $categories = Category::withCount('posts')->orderBy('posts_count', 'desc')->take(10)->get();
        $tags = Tag::latest()->take(50)->get();

        return view('theme.default.tags.show', [
            'tag' => $tag,
            'posts' => $tag->posts()->paginate(10),
            'recent_posts' => $recent_posts,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    public function search(Request $request){
        $search = $request->input('search');
        $post_id = $request->has('postId') ? $request->input('postId') : null;

        $tags = Tag::where('tags.name', 'like', $search.'%')
            ->select('id', 'tags.name')
            ->get();

        /*
        if($post_id != null){
            $post = Post::find($post_id);
            $post_tags = $post->getTagNames();
        }
        */
        $post_tags = [];

        $tags_array = [];
        foreach($tags as $tag){
            if($post_id != null && in_array($tag->name, $post_tags)){
                continue;
            }

            $tags_array[] = [
                'id' => $tag->id,
                'text' => $tag->name
            ];
        }


        return [
            'results' => $tags_array
        ];
    }
}
