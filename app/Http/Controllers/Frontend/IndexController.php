<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;


class IndexController extends Controller
{
    public function index()
    {
        $recent_posts = Post::latest()->withCount('comments')->paginate(10);
        return view('/theme.default.index', [
        'recent_posts' => $recent_posts,
        ]);  
    }  
}