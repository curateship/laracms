<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    //
    public function getList(){
        $list = Notification::getNotificationsList(Auth::id(), 'unread');

        foreach($list as $item){
            if($item->init_user_id != null){
                $author = User::find($item->init_user_id);
                $item->author = $author;
            }   else{
                $item->author = null;
            }
        }


        return [
            'content' => view('components.layouts.headers.notifications.notifications-list', [
                    'notifications_list' => $list]
            )->render(),
            'count' => count($list)
        ];
    }

    public function markAsRead(Request $request){
        $notification = Notification::find($request->input('notificationId'));

        if($notification->user_id != Auth::id()){
            return abort(404);
        }

        return $notification->markAsRead();
    }
}
