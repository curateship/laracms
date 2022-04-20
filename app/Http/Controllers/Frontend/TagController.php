<?php

namespace App\Http\Controllers\Frontend;

// Others
use App\Http\Controllers\Controller;
use App\Models\TagsCategories;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;

// Models
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class TagController extends Controller
{
    public function show($tags_categories_name, $tag_name)
    {
        $recent_posts = Post::latest()->take(5)->get();
        $categories = Tag::take(10)->get();
        $tags = Tag::latest()->take(50)->get();

        $category = TagsCategories::where('name', $tags_categories_name)
            ->first();

        if($category == null){
            return abort(404);
        }

        $tag = Tag::where('name', $tag_name)
            ->where('category_id', $category->id)
            ->first();

        if($tag == null){
            return abort(404);
        }

        // SEO Title
        SEOMeta::setTitle($tag->name);
        return view('theme.tags.show', [
            'tag' => $tag,
            'posts' => $tag->posts()->paginate(10),
            'recent_posts' => $recent_posts,
            'categories' => $categories,
            'tags' => $tags
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

        $tags = Tag::where('category_id', $category->id)
            ->leftJoin('tags_categories', 'tags_categories.id', '=', 'tags.category_id')
            ->select(['tags.*', 'tags_categories.name as cat_name'])
            ->paginate(10);

        //admin.categories.index
        return view('theme.tags.categories', [
            'category' => $category,
            'tags' => $tags
        ]);
    }
}
