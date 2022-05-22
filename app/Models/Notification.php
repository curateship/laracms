<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $url
 * @property mixed $content
 * @property mixed $title
 * @property mixed $init_user_id
 * @property mixed $user_id
 * @property \Illuminate\Support\Carbon $read_at
 * @property mixed $post_id
 */
class Notification extends Model
{
    use HasFactory;

    public static function send($target_user_id, $init_user_id, $title, $content, $url, $post_id){
        $notification = new static();
        $notification->user_id = $target_user_id;
        $notification->init_user_id = $init_user_id;
        $notification->title = $title;
        $notification->content = $content;
        $notification->url = $url;
        $notification->post_id = $post_id;
        $notification->save();
    }

    public function markAsRead(){
        $this->read_at = now();
        $this->save();

        return true;
    }

    public static function getNotificationsList($user_id, $type = 'all'){
        $notifications = static::where('user_id', $user_id);

        if($type == 'all'){
            $notifications = $notifications->orderBy('read_at', 'ASC')
                ->orderBy('created_at', 'DESC');
        }

        if($type == 'unread'){
            $notifications = $notifications->whereNull('read_at')
                ->orderBy('created_at', 'DESC');
        }

        if($type == 'read'){
            $notifications = $notifications->where('read_at')
                ->orderBy('read_at', 'DESC');
        }

        return $notifications
            ->where('visible', 1)
            ->get();
    }

    public static function removeNotificationForPost($post_id){
        Notification::where('post_id', $post_id)
            ->delete();
    }
}
