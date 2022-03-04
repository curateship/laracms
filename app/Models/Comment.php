<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

/**
 * @property mixed $user_id
 */
class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['the_comment', 'post_id', 'user_id'];

    public function post ()
    {
        return $this->belongsTo(Post::class);
    }

    public function user ()
    {
        return $this->belongsTo(Post::class);
    }
}
