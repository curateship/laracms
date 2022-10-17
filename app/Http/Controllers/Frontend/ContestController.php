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

        $posts = Post::where('status', 'published')->where('posts.category_id', '!=', 2)->latest()->withCount('comments')->whereNotNull('user_id')->where('contest_id', $contest->id)->paginate(16);

        return view('components.contests.show', [
            'recent_posts' => $posts,
            'contest' => $contest,
            'author' => $author,
            'author_avatar' => $author_avatar,
            'followed' => $followed,
        ]);
    }

    public function showList(){
        $contests = Contest::all();
        return view('components.contests.list', [
            'contests' => $contests
        ]);
    }
}
