<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property mixed $id
 * @property mixed|string $name
 */
class TagsCategories extends Model
{
    use HasFactory;

    public function tags(){
        return Tag::where('category_id', $this->id)
            ->get();
    }

    public static function popularTags($category_name, $limit = 10){
        return Tag::where('tags_categories.name', $category_name)
            ->leftJoin('tags_categories', 'tags_categories.id', '=', 'tags.category_id')
            ->leftJoin(DB::raw('(
                select tag_id, count(*) as post_count
                from post_tag
                left join posts on posts.id = post_tag.post_id
                where posts.status = "published"
                group by tag_id
            ) as post_tag'), 'post_tag.tag_id', '=', 'tags.id')
            ->orderBy('post_count', 'desc')
            ->limit($limit)
            ->select(['tags.*', 'post_count'])
            ->get();
    }

    public function posts(){
        return Post::leftJoin('post_tag', 'post_tag.post_id', '=', 'posts.id')
            ->leftJoin('tags', 'tags.id', '=', 'post_tag.tag_id')
            ->where('posts.status', 'published')
            ->where('tags.category_id', $this->id)
            ->select('posts.*')
            ->get();
    }
}
