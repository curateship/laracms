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

    public function replies($only_count = false, $last_comment_id = 0){
        if($only_count){
            if($last_comment_id == 0){
                return static::where('reply_id', $this->id)
                    ->count();
            }   else{
                $comments = static::where('reply_id', $this->id)
                    ->where('comments.id', '<', $last_comment_id);

                return count($comments->get());
            }

        }   else{
            $comments = static::where('reply_id', $this->id)
                ->leftJoin('users', 'users.id', '=', 'comments.user_id')
                ->select([
                    'comments.*',
                    'users.name as author_name',
                    'users.thumbnail as author_thumbnail'
                ])
                ->orderBy('comments.created_at', 'DESC')
                ->limit(10);

                if($last_comment_id > 0){
                    $comments = $comments->where('comments.id', '<', $last_comment_id);
                }

            return $comments->get();
        }
    }

    public function existMoreComments($last_comment_id = 0){
        $comment_block = Comment::where('post_id', $this->id)
            ->whereNull('reply_id');

        if($last_comment_id > 0){
            $comment_block = $comment_block->where('id', '<', $last_comment_id);
        }

        return count($comment_block->get());
    }

    public function relatedPost(){
        return Post::find($this->post_id);
    }
}
