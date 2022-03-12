<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $id
 */
class TagsCategories extends Model
{
    use HasFactory;

    public function tags(){
        return Tag::where('category_id', $this->id)
            ->get();
    }

    public function posts(){
        return Post::leftJoin('post_tag', 'post_tag.post_id', '=', 'posts.id')
            ->leftJoin('tags', 'tags.id', '=', 'post_tag.tag_id')
            ->where('tags.category_id', $this->id)
            ->select('posts.*')
            ->get();
    }
}
