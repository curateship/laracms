<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contest;
use App\Models\Follow;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContestController extends Controller
{
    //

    // Show;
    public function show($any){
        $contest = Contest::where('slug', $any)
            ->first();

        if($contest == null){
            return abort(404);
        }

        $author = $contest->author();
        $author_avatar = $author->getAvatar(false, ['width' => 32, 'height' => 32], ['block', 'width-100%', 'height-100%', 'object-cover'])->content;

        $followed = false;
        if(!Auth::guest()){
            $follow_status = Follow::where('follow_contest_id', $contest->id)
                ->where('user_id', Auth::id())
                ->first();

            if($follow_status != null){
                $followed = true;
            }
        }

        $contest_top = Follow::where('follow_contest_id', $contest->id)
            ->whereNotNull('contest_place')
            ->orderBy('contest_place', 'ASC')
            ->get();

        $top = [];
        $top_ids = [];
        foreach($contest_top as $key => $follow){
            if($key == 3){
                break;
            }

            $follow_post = Post::where('user_id', $follow->user_id)
                ->where('contest_id', $follow->follow_contest_id)
                ->first();

            $top[$follow->contest_place][] = $follow_post;
            $top_ids[] = $follow_post->id;
        }

        $posts = Post::whereNotIn('id', $top_ids)->where('status', 'published')->where('posts.category_id', '!=', 2)->latest()->withCount('comments')->whereNotNull('user_id')->where('contest_id', $contest->id)->paginate(16);

        return view('components.contests.show', [
            'top' => $top,
            'recent_posts' => $posts,
            'contest' => $contest,
            'author' => $author,
            'author_avatar' => $author_avatar,
            'followed' => $followed,
        ]);
    }

    public function showList(){
        $contests = Contest::whereNotIn('status', ['draft'])
            ->get();

        $result = [
            'open' => [],
            'published' => [],
            'close' => []
        ];
        foreach($contests as $contest){
            $result[$contest->status][] = $contest;
        }

        return view('components.contests.list', [
            'contests_list' => $result
        ]);
    }
}
