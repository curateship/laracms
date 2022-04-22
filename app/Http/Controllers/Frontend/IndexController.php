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
        SEOMeta::setTitle(config('seotools.static_titles.'.get_called_class().'.'.__FUNCTION__));

        $posts = Post::where('status', 'published')->latest()->withCount('comments')->whereNotNull('user_id')->paginate(10);

        return view('/theme.index', [
            'recent_posts' => $posts,
            'popular_posts' => Post::getPostsListByView('month')
        ]);
    }
}
