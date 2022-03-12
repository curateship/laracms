<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Post;
use App\Models\User;

/**
 * @property mixed $id
 */
class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug' ,'user_id'];

    public function posts()
    {
        return Post::leftJoin('post_tag', 'post_tag.post_id', '=', 'posts.id')
            ->where('tag_id', $this->id)
            ->select('posts.*');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
