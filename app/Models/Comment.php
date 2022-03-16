<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

/**
 * @property mixed $user_id
 * @property mixed $id
 * @property mixed $reply_id
 * @property mixed $the_comment
 * @property mixed $post_id
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
        return User::find($this->user_id);//$this->belongsTo(User::class);
    }

    public function replies($only_count = false){
        if($only_count){
            return static::where('reply_id', $this->id)
                ->count();
        }   else{
            return static::where('reply_id', $this->id)
                ->leftJoin('users', 'users.id', '=', 'comments.user_id')
                ->select([
                    'comments.*',
                    'users.name as author_name',
                    'users.thumbnail as author_thumbnail'
                ])
                ->get();
        }
    }
}
