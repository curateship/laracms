<?php

namespace App\Http\Controllers\Frontend;

// Others
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;

// Models
use App\Models\Post;

// Supports
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;


class IndexController extends Controller
{
    public function index()
    {
        SEOMeta::setTitle('Site Title');
        $recent_posts = Post::latest()->withCount('comments')->with('author')->paginate(10);
        return view('/themes.jpn.index', [
        'recent_posts' => $recent_posts,
        ]);  
    }  
}