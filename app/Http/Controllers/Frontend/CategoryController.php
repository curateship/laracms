<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\TagsCategories;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = TagsCategories::orderBy('id', 'DESC')->paginate(10);

        $cats = [];
        foreach($categories as $category){
            $cats[] = $category->id;
        }

        $tags = Tag::whereIn('category_id', $cats)
            ->leftJoin('categories', 'categories.id', '=', 'tags.category_id')
            ->select(['tags.*', 'categories.name as cat_name'])
            ->get();

        $tags_in_cats = [];
        foreach($tags as $tag){
            $tags_in_cats[$tag->category_id][] = $tag;
        }

        //admin.categories.index
        return view('theme.tags.categories', [
            'categories' => $categories,
            'tags' => $tags_in_cats
        ]);
    }

    public function show(Category $category)
    {
        $posts = Post::latest()->take(5)->get();
        $recent_posts = Post::latest()->take(5)->get();
        $categories = Category::withCount('posts')->orderBy('posts_count', 'desc')->take(5)->get();
        $tags = Tag::latest()->take(10)->get();

        return view('theme.categories.show', [
            'category' => $category,
            'posts' => $category->posts()->paginate(10),
            'recent_posts' => $recent_posts,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }
}
