<?php

namespace App\Http\Controllers\Frontend;

// Others
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\User;
use App\Models\Role;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

// Supports
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;


class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->withCount('comments')->paginate(10);
        $recent_posts = Post::where('status', 'published')->where('posts.category_id', '!=', 2)->latest()->withCount('comments')->paginate(8);
        $categories = Category::withCount('posts')->orderBy('posts_count', 'desc')->take(5)->get();
        $tags = Tag::latest()->take(10)->get();

        return view('/theme.dashboard.index', [
            'posts' => $posts,
            'recent_posts' => $recent_posts,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    public function getListBadges(){
        $posts = Post::groupBy('status')
            ->selectRaw('status, count(*) as count');

        if(!Gate::allows('is-admin')){
            $posts = $posts->where('user_id', Auth::id());
        }

        $posts = $posts->get();

        $templates = [
            'drafts' => 0,
            'published' => 0
        ];

        foreach($posts as $post){
            switch($post->status){
                case 'published':
                    $templates['published'] += $post->count;
                    break;
                case 'draft':
                    $templates['drafts'] += $post->count;
                    break;
            }
        }

        $templates['total'] = $templates['drafts'] + $templates['published'];

        return $templates;
    }
}



