<?php

namespace App\Http\Controllers\Frontend;

// Others
use App\Http\Controllers\Controller;
use App\Models\TagsCategories;
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
        $posts = Post::where('status', 'published')->latest()->withCount('comments')->whereNotNull('user_id')->paginate(16);
        
        return view('/theme.index.full-width', [
            'recent_posts' => $posts,
            'popular_posts' => Post::getPostsListByView('month'),
            'specific_tag_posts' => Post::getListByTagName('Featured', ['by' => 'created_at', 'order' => 'desc'], 10),
            'popular_tags_category_name' => 'origins',
            'popular_tags' => TagsCategories::popularTags('origins')->take(30),
        ]);
    }
}
