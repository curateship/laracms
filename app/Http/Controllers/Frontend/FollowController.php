<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    //
    public function followUser(Request $request){
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

    public function followTag(Request $request){
        $follow_tag_id = $request->input('tagId');
        $exist_follow = Follow::where('follow_tag_id', $follow_tag_id)
            ->where('user_id', Auth::id())
            ->first();

        // If following exist - unfollow;
        if($exist_follow != null){
            Follow::where('follow_tag_id', $follow_tag_id)
                ->where('user_id', Auth::id())
                ->delete();

            return [
                'status' => 0
            ];
        }   else{
            $follow = new Follow();
            $follow->follow_tag_id = $follow_tag_id;
            $follow->user_id = Auth::id();
            $follow->save();

            return [
                'status' => 1
            ];
        }
    }

    public function followContest(Request $request){
        $follow_contest_id = $request->input('contestId');
        $follow_contest = Follow::where('follow_contest_id', $follow_contest_id)
            ->where('user_id', Auth::id())
            ->first();

        // If following exist - unfollow;
        if($follow_contest != null){
            Follow::where('follow_contest_id', $follow_contest_id)
                ->where('user_id', Auth::id())
                ->delete();

            return [
                'status' => 0
            ];
        }   else{
            $follow = new Follow();
            $follow->follow_contest_id = $follow_contest_id;
            $follow->user_id = Auth::id();
            $follow->save();

            return [
                'status' => 1
            ];
        }
    }
}
