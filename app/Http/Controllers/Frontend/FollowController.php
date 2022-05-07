<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    //
    public function follow(Request $request){
        $follow_user_id = $request->input('userId');
        $exist_follow = Follow::where('follow_user_id', $follow_user_id)
            ->where('user_id', Auth::id())
            ->first();

        // If following exist - unfollow;
        if($exist_follow != null){
            Follow::where('follow_user_id', $follow_user_id)
                ->where('user_id', Auth::id())
                ->delete();

            return [
                'status' => 0
            ];
        }   else{
            $follow = new Follow();
            $follow->follow_user_id = $follow_user_id;
            $follow->user_id = Auth::id();
            $follow->save();

            return [
                'status' => 1
            ];
        }
    }
}
