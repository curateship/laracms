<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('theme.categories.index', [
            'categories' => Category::withCount('posts')->paginate(100)
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