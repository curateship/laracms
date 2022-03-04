<?php

namespace App\Http\Controllers\Frontend;

// Others
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Post;

// Supports
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;


class IndexController extends Controller
{
    public function index()
    {
        $recent_posts = Post::latest()->withCount('comments')->paginate(10);
        return view('/themes.default.index', [
        'recent_posts' => $recent_posts,
        ]);  
    }  
}