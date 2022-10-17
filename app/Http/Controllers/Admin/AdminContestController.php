<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contest;
use App\Models\Follow;
use App\Models\Post;
use App\Models\User;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class AdminContestController extends Controller
{
    //

    // List
    public function index(Request $request)
    {

        SEOMeta::setTitle(config('seotools.static_titles.'.get_called_class().'.'.__FUNCTION__));
        if($request->has('sortBy') && $request->input('sortBy') !== 'role'){
            $contests = Contest::orderBy($request->input('sortBy'), $request->input('sortDesc'));
        }   else{
            $contests = Contest::orderBy('created_at', 'DESC');
        }

        $status = 'All';
        if($request->has('status') && $request->input('status') != 'All'){
            $contests = $contests->where('status', strtolower($request->input('status')));
            $status = ucfirst($request->input('status'));
        }

        if($request->has('search') && $request->input('search') != ''){
            $search_input = $request->input('search');
            $contests = $contests->where(function($query) use ($search_input){
                $query->where('title', 'like', '%'.$search_input.'%')
                    ->orWhere('body', 'like', '%'.$search_input.'%');
            });
        }

        $contests->leftJoin(DB::raw('(
                select follow_contest_id, count(*) as joined
                from follows
                where follow_contest_id is not null
                group by follow_contest_id
            ) as follows'), 'follows.follow_contest_id', '=', 'contests.id')
            ->leftJoin(DB::raw('(
                select contest_id, count(*) as posts_count
                from posts
                where contest_id is not null
                group by contest_id
            ) as posts'), 'posts.contest_id', '=', 'contests.id')
            ->selectRaw('contests.*, follows.joined, posts.posts_count');

        return view('admin.contests.index', [
            'counters' => Contest::getCounters(),
            'contests' => $contests->paginate(10),
            'status' => $status
        ]);
    }

    // Create
    public function create()
    {
        return view('admin.contests.create');
    }

    public function getContestFollower($contest_id){
        $followers = User::leftJoin('follows', 'follows.user_id', '=', 'users.id')
            ->where('follows.follow_contest_id', $contest_id)
            ->select('users.*')
            ->orderBy('follows.created_at', 'DESC')
            ->get();

        $data = view('components.contests.layouts.followers', [
            'followers' => $followers
        ])->render();

        return [
            'status' => 200,
            'result' => $data
        ];
    }

    // Edit
    public function edit($contest_slug)
    {
        $contest = Contest::where('slug', $contest_slug)
            ->first();

        if($contest == null){
            return abort(404);
        }

        // Only author or author can preview posts in draft;
        if(!Gate::allows('is-admin')){
            return abort(404);
        }

        return view('admin.contests.edit', [
            'contest' => $contest
        ]);
    }

    public function store(Request $request){
        $title = $request->input('title');

        // Generate slug
        $slug = Str::slug($title, '-');
        $posts_with_same_slug = Contest::where('slug', 'like', $slug . '%');

        if($request->has('contestId')){
            $posts_with_same_slug = $posts_with_same_slug->where('id', '!=', $request->input('contestId'));
        }
        $posts_with_same_slug = $posts_with_same_slug->get();

        if (count($posts_with_same_slug) > 0) {
            $slug = Post::getNewSlug($slug, $posts_with_same_slug);
        }

        if(!Contest::checkExitRoute($slug)){
            $slug .= '-contest';
        }

        $original = ( $request->has('original') && !empty($request->input('original')) ) ? $request->input('original') : NULL;
        $original = str_replace(url('/storage'.config('images.contests_storage_path')), '', $original);

        $thumbnail = ( $request->has('thumbnail') && !empty($request->input('thumbnail')) ) ? $request->input('thumbnail') : NULL;
        $thumbnail = str_replace(url('/storage'.config('images.contests_storage_path')), '', $thumbnail);

        $medium = ( $request->has('medium') && !empty($request->input('medium')) )  ? $request->input('medium') : NULL;
        $medium = str_replace(url('/storage'.config('images.contests_storage_path')), '', $medium);

        if($request->has('contestId')){
            $contest = Contest::find($request->has('contestId'));


            // Remove tag image if it was updated;
            if($contest->original != $original){
                $contest->removeTagImages('main');
            }

            // If body was update;
            if($contest->body != $request->input('description')){
                $path = '/public'.config('images.contests_storage_path');

                // Get current body images;
                $current_images = [];

                $body_array = json_decode($contest->body, true);
                if(isset($body_array['blocks'])){
                    foreach($body_array['blocks'] as $block){
                        if($block['type'] == 'image'){
                            $url_array = explode('/', $block['data']['file']['url']);
                            $current_images[] = Arr::last($url_array);
                        }
                    }
                }

                // New tag images;
                $new_images = [];
                $body_array = json_decode($request->input('description'), true);
                foreach($body_array['blocks'] as $block){
                    if($block['type'] == 'image'){
                        $url_array = explode('/', $block['data']['file']['url']);
                        $new_images[] = Arr::last($url_array);
                    }
                }

                // If we do not have old image in new list - delete this file;
                foreach($current_images as $image){
                    if(!in_array($image, $new_images)){
                        Storage::delete($path.'/original/'.$image);
                        Storage::delete($path.'/medium/'.$image);
                        Storage::delete($path.'/thumbnail/'.$image);
                    }
                }
            }

        }   else{
            $contest = new Contest();
        }

        $contest->original = $original;
        $contest->thumbnail = $thumbnail;
        $contest->medium = $medium;
        $contest->title = $title;
        $contest->body = $request->input('description');
        $contest->slug = $slug;
        $contest->status = $request->input('status');
        $contest->user_id = Auth::id();
        $contest->save();

        return redirect('/admin/contests');
    }

    // Destroy
    public function destroy(string $ids, Request $request)
    {
        $ids = explode(',', $ids);

        foreach($ids as $id){
            // Remove contest images;
            $contest = Contest::find($id);
            $contest->removeTagImages('main');
            $contest->removeTagImages('body');

            Post::query()->where('contest_id', $id)
                ->update([
                    'contest_id' => null
                ]);

            Follow::query()->where('follow_contest_id', $id)
                ->delete();

            $contest->delete();
        }

        $request->session()->flash('success', 'You have delete the contest');
    }

    // Upload
    public function upload($upload_type, Request $request){
        $path = '/public'.config('images.contests_storage_path');
        $mime_type = $request->file('image')->getMimeType();
        $media_path = storage_path() . "/app";
        $media = [
            'original', 'medium', 'thumbnail'
        ];

        foreach($media as $key => $type){
            File::ensureDirectoryExists($media_path . '/public/contests/'.$type);
            $media[$type] = config("images.$type");
            unset($media[$key]);
        }
        unset($media['original']);

        // Save original media file in file system;
        $original = request()->file('image')->getClientOriginalName();
        $thumbnail_medium_name = Str::random(27) . '.' . Arr::last(explode('.', $original));

        $original = request()->file('image')->storeAs($path."/original", $thumbnail_medium_name);

        foreach($media as $type_name => $type){
            if ($mime_type == 'image/gif') {
                /* GIF */
                $thumbnail_medium = new Imagick($media_path.'/'.$original);
                $thumbnail_medium = $thumbnail_medium->coalesceImages();
                do {
                    $thumbnail_medium->resizeImage( $type['width'], $type['height'], Imagick::FILTER_BOX, 1, true );
                } while ( $thumbnail_medium->nextImage());

                $thumbnail_medium = $thumbnail_medium->deconstructImages();

                $thumbnail_medium->writeImages($media_path . "/public/contests/$type_name/" . $thumbnail_medium_name, true);
            }   else{
                /* Other Image types */
                $thumbnail_medium = Image::make(request()->file('image'));
                $thumbnail_medium->resize($type['width'], $type['height'], function($constraint){
                    $constraint->aspectRatio();
                });


                $thumbnail_medium->save($media_path . "/public/contests/$type_name/" . $thumbnail_medium_name);
            }

            $media[$type_name]['path'] = $media_path . "/public/contests/$type_name/" . $thumbnail_medium_name;
        }

        foreach($media as $key => $item){
            $media[$key]['path'] = url('/').Storage::url(str_replace($media_path.'/', '', $item['path']));
            unset($media[$key]['width']);
            unset($media[$key]['height']);
        }

        $media['original']['path'] = url('/').Storage::url($original);

        if($upload_type == 'main'){
            return $media;
        }

        if($upload_type == 'editor'){
            return [
                'success' => 1,
                'file' => [
                    'url' => $media['medium']['path']
                ]
            ];
        }
    }

    public function getPosts($contest_id){
        $posts = Post::query()->where('contest_id', $contest_id)
            ->get();


        return [
            'status' => 200,
            'count' => count($posts),
            'result' => view('admin.contests.layout.posts', [
                'posts' => $posts
            ])->render()
        ];
    }

    public function getFollows($contest_id){
        $follows = User::leftJoin('follows', 'follows.user_id', '=', 'users.id')
            ->where('follow_contest_id', $contest_id)
            ->whereNotNull('follow_contest_id')
            ->selectRaw('users.*, follows.id as follow_id, follows.follow_contest_id')
            ->get();


        return [
            'status' => 200,
            'count' => count($follows),
            'result' => view('admin.contests.layout.follows', [
                'follows' => $follows
            ])->render()
        ];
    }

    public function removeFollow(Request $request){
        Follow::where('id', $request->input('id'))
            ->delete();

        return [
            'status' => 200
        ];
    }

    public function removePostFromContest(Request $request){
        Post::query()->where('id', $request->input('id'))
            ->where('contest_id', $request->input('contest_id'))
            ->update([
                'contest_id' => null
            ]);

        return [
            'status' => 200
        ];
    }
}
