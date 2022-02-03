<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;


class HomeController extends Controller
{
    public function index()
    {
        $recent_posts = Post::withCount('comments')->get();
        $recent_posts = Post::latest()->take(8)->get();
        $categories = Category::withCount('posts')->orderBy('posts_count', 'desc')->take(5)->get();

        return view('home', [
        'recent_posts' => $recent_posts,
        'categories' => $categories
        ]);  
    }  
}



