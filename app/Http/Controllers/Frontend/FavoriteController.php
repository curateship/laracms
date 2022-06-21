<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class FavoriteController extends Controller
{
    //
    public function removeList(Request $request){
        $list = Favorite::where('user_id', Auth::id())
            ->where('id', $request->input('listId'))
            ->first();

        if($list != null){
            DB::table('favorites_items')
                ->where('favorite_id', $list->id)
                ->delete();

            Favorite::where('user_id', Auth::id())
                ->where('id', $request->input('listId'))
                ->delete();
        }

        return [
            'status' => 200
        ];
    }

    public function getListCreateForm(){
        return [
            'status' => 200,
            'data' => view('components.layouts.partials.lists.create')->render()
        ];
    }

    public function showListPosts($slug){
        $favorite = Favorite::where('slug', $slug)
            ->first();

        if($favorite == null){
            return abort(404);
        }

        if($favorite->public == 0 && Auth::guest()){
            return abort(404);
        }

        $posts = Post::where('status', 'published')
            ->leftJoin('favorites_items', 'favorites_items.post_id', '=', 'posts.id')
            ->leftJoin('favorites', 'favorites.id', '=', 'favorites_items.favorite_id')
            ->where('favorites.slug', $slug)
            ->select('posts.*')
            ->paginate(10);

        return view('theme.lists.show', [
            'fav_name' => $favorite->name,
            'posts' => $posts
        ]);
    }

    public function showUserLists(){
        $favorites = Favorite::leftJoin(DB::raw('(
                select favorite_id , GROUP_CONCAT(post_id) as post_list, count(*) as posts_count from favorites_items group by favorite_id
            ) as lists'), 'lists.favorite_id', '=', 'favorites.id')
            ->orderBy('favorites.id', 'DESC')
            ->select('favorites.*', 'posts_count')
            ->where('post_list', '>', 0);

        if(!Auth::guest()){
            $favorites = $favorites->where('user_id', Auth::id());
        }  else{
            $favorites = $favorites->where('public', 1);
        }

        $favorites = $favorites->paginate(10);

        foreach($favorites as $favorite){
            $favorite->author = User::find($favorite->user_id);
        }

        return view('theme.lists.index', [
            'favorites' => $favorites
        ]);
    }

    public function addItem(Request $request){
        $list = Favorite::where('user_id', Auth::id())
            ->where('id', $request->input('listId'))
            ->first();

        if($list == null){
            return [
                'status' => 500
            ];
        }

        // If item exist - remove it;
        $exist_item = DB::table('favorites_items')
            ->where('post_id', $request->input('postId'))
            ->where('favorite_id', $request->input('listId'))
            ->first();

        if($exist_item != null){
            DB::table('favorites_items')
                ->where('post_id', $request->input('postId'))
                ->where('favorite_id', $request->input('listId'))
                ->delete();
        }   else{
            DB::table('favorites_items')
                ->insert([
                    'favorite_id' => $list->id,
                    'post_id' => $request->input('postId'),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
        }

        $post = Post::find($request->input('postId'));

        return [
            'status' => 200,
            'user_listed' => $post->userListed(),
            'lists_count' => $post->listsCount()
        ];
    }

    public function getList(Request $request){
        $lists = Favorite::where('user_id', Auth::id())
            ->leftJoin(DB::raw('(
                select favorite_id , GROUP_CONCAT(post_id) as post_list, count(*) as posts_count from favorites_items group by favorite_id
            ) as lists'), 'lists.favorite_id', '=', 'favorites.id')
            ->select('favorites.name', 'favorites.id', 'post_list', 'posts_count', 'favorites.thumbnail')
            ->orderBy('created_at', 'DESC')
            ->limit(10);

        if($request->has('search')){
            $lists = $lists->where('favorites.name', 'LIKE', '%'.$request->input('search').'%');
        }

        $lists = $lists->get();

        foreach($lists as $list){
            if($list->posts_count == null){
                $list->posts_count = 0;
            }

            $list->thumbnail = '/storage'.config('images.lists_storage_path').$list->thumbnail;

            $posts = explode(',', $list->post_list);
            $list->in_list = in_array($request->input('postId'), $posts);
        }

        return [
            'status' => 200,
            'data' => view('components.layouts.partials.lists.list', [
                'list' => $lists
            ])->render()
        ];
    }

    public function upload($upload_type, Request $request){
        $path = '/public'.config('images.lists_storage_path');
        $mime_type = $request->file('image')->getMimeType();
        $media_path = storage_path() . "/app";
        $media = [
            'original', 'medium', 'thumbnail'
        ];

        foreach($media as $key => $type){
            File::ensureDirectoryExists($media_path . '/public/lists/'.$type);
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

                $thumbnail_medium->writeImages($media_path . "/public/lists/$type_name/" . $thumbnail_medium_name, true);
            }   else{
                /* Other Image types */
                $thumbnail_medium = Image::make(request()->file('image'));
                $thumbnail_medium->resize($type['width'], $type['height'], function($constraint){
                    $constraint->aspectRatio();
                });


                $thumbnail_medium->save($media_path . "/public/lists/$type_name/" . $thumbnail_medium_name);
            }

            $media[$type_name]['path'] = $media_path . "/public/lists/$type_name/" . $thumbnail_medium_name;
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

    public function createNew(Request $request){
        $images = $request->input('images');

        $original = str_replace(url('/storage'.config('images.lists_storage_path')), '', $images['original']);
        $thumbnail = str_replace(url('/storage'.config('images.lists_storage_path')), '', $images['thumbnail']);
        $medium = str_replace(url('/storage'.config('images.lists_storage_path')), '', $images['medium']);

        // Generate slug
        $title = $request->input('title');
        $slug = Str::slug($title, '-');
        $posts_with_same_slug = Favorite::where('slug', 'like', $slug . '%')
            ->get();

        if (count($posts_with_same_slug) > 0) {
            $slug = Post::getNewSlug($slug, $posts_with_same_slug);
        }

        $list = new Favorite();
        $list->user_id = Auth::id();
        $list->name = $title;
        $list->original = $original;
        $list->thumbnail = $thumbnail;
        $list->medium = $medium;
        $list->slug = $slug;
        $list->public = $request->input('public');
        $list->save();

        return [
            'status' => 200
        ];
    }
}
