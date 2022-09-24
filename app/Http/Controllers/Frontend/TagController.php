<?php

namespace App\Http\Controllers\Frontend;

// Others
use App\Http\Controllers\Controller;
use App\Models\Follow;
use App\Models\TagsCategories;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

// Models
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TagController extends Controller
{
    public function show(Request $request, $tags_categories_name, $tag_slug)
    {
        $recent_posts = Post::latest()->take(5)->get();
        $categories = Tag::take(30)->get();
        $tags = Tag::latest()->take(50)->get();

        $category = TagsCategories::where('name', $tags_categories_name)
            ->first();

        if($category == null){
            return abort(404);
        }

        $tag = Tag::where('slug', $tag_slug)
            ->where('category_id', $category->id)
            ->first();

        if($tag == null){
            return abort(404);
        }

        if(!Auth::guest()){
            $follow = Follow::where('follow_tag_id', $tag->id)
                ->where('user_id', Auth::id())
                ->first();

            $followed = $follow != null;
        }   else{
            $followed = false;
        }

        $char_tags_result = [];
        $result_posts = [];

        if(!$request->has('characters')){
            $result_posts = $tag->posts()->paginate(10);
        }

        if($tags_categories_name == 'origins'){
            // Get all character tags;
            $char_tags = Tag::where('category_id', 3)
                ->get();

            Log::info(print_r($char_tags, true));

            foreach($char_tags as $char_tag){
                if($request->has('characters') && $request->input('characters') == $char_tag->slug){
                    $result_posts = Post::getFilteredListByTagName(
                        [
                            'origins' => $tag_slug,
                            'characters' => $char_tag->slug
                        ], false, 10
                    );
                }

                $posts = Post::getFilteredListByTagName(
                    [
                        'origins' => $tag_slug,
                        'characters' => $char_tag->slug
                    ], true
                );

                Log::info('origins slug: '.$tag_slug);
                Log::info('characters slug: '.$char_tag->slug);
                Log::info('count: '.$posts);

                if($posts > 0){
                    $char_tags_result[] = [
                        'name' => $char_tag->name,
                        'slug' => $char_tag->slug
                    ];
                }
            }
        }

        // SEO Title
        SEOMeta::setTitle($tag->name);
        return view(config('theme.tag_theme'), [
            'char_tags_result' => $char_tags_result,
            'category' => $category,
            'tag' => $tag,
            'posts' => $result_posts,
            'recent_posts' => $recent_posts,
            'categories' => $categories,
            'tags' => $tags,
            'followed' => $followed
        ]);
    }

   // Search
    public function search(Request $request){
        $search = $request->input('search');
        $category_id = $request->has('categoryId') ? $request->input('categoryId') : null;

        $tags = Tag::where('tags.name', 'like', $search.'%')
            ->where('category_id', $category_id)
            ->select('id', 'tags.name')
            ->get();

        $tags_array = [];
        foreach($tags as $tag){
            $tags_array[] = [
                'id' => $tag->id,
                'text' => $tag->name
            ];
        }

        return [
            'results' => $tags_array
        ];
    }

    public function showCategory($category_name){
        $category = TagsCategories::where('name', $category_name)->first();

        if($category == null){
            return abort(404);
        }

        $tags = Tag::where('category_id', $category->id)
            ->leftJoin(DB::raw("(
                select tags.id as tag_id
                from tags
                left join post_tag on post_tag.tag_id = tags.id
                left join posts on posts.id = post_tag.post_id
                where tags.category_id = $category->id
                and posts.status = 'published'
                group by tags.id
            ) as true_tags"), 'true_tags.tag_id', '=', 'tags.id')
            ->leftJoin('tags_categories', 'tags_categories.id', '=', 'tags.category_id')
            ->whereNotNull('true_tags.tag_id')
            ->select(['tags.*', 'tags_categories.name as cat_name'])
            ->paginate(50);

        return view('theme.tags.categories', [
            'category' => $category,
            'tags' => $tags
        ]);
    }
}
