<?php

namespace App\Http\Controllers\Admin;

// Others
use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Like;
use App\Models\Notification;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;

// Models
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Role;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\TagsCategories;

// Support
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Imagick;
use Thumbnail;

class AdminFavoriteController extends Controller
{
    // Create
    public function create()
    {
        return view('admin.posts.create', [
            'categories' => Category::pluck('name', 'id')
        ]);
    }

    // Edit
    public function edit($favorite_id)
    {
        $favorite = Favorite::find($favorite_id);

        // Only author or author can preview posts in draft;
        if(!Gate::allows('is-admin') && (!Auth::guest() && Auth::id() != $favorite->user_id)){
            return abort(404);
        }

        if($favorite == null){
            return abort(404);
        }

        return view('admin.favorites.edit', [
            'favorite' => $favorite
        ]);
    }

    // Destroy
    public function destroy(string $ids, Request $request)
    {

        $ids = explode(',', $ids);

        foreach($ids as $id){
            $list = Favorite::find($id);

            // Delete fav list image;
            $path = '/public'.config('images.lists_storage_path');
            Storage::delete($path.$list->original);
            Storage::delete($path.$list->medium);
            Storage::delete($path.$list->thumbnail);

            if($list != null){
                DB::table('favorites_items')
                    ->where('favorite_id', $list->id)
                    ->delete();

                $list->delete();
            }
        }

        if(count($ids) > 1){
            $request->session()->flash('success', 'You have deleted all selected favorites');
        }   else{
            $request->session()->flash('success', 'You have deleted the favorite');
        }
    }

    // Store or update;
    public function store(Request $request){
        if($request->has('status') && $request->input('status') == 'delete'){
            $list = Favorite::find($request->input('favoriteId'));

            if(Auth::id() == $list->user_id || Gate::allows('is-admin')){
                // Delete fav list image;
                $path = '/public'.config('images.lists_storage_path');

                Storage::delete($path.$list->original);
                Storage::delete($path.$list->medium);
                Storage::delete($path.$list->thumbnail);

                if($list != null){
                    DB::table('favorites_items')
                        ->where('favorite_id', $list->id)
                        ->delete();

                    $list->delete();
                }

                return redirect('/favorites');
            }

            return abort(404);
        }

        $title = strip_tags($request->input('name'));

        // Generate slug
        $slug = Str::slug($title, '-');
        $favorite_with_same_slug = Favorite::where('slug', 'like', $slug . '%')
            ->where('id', '!=', $request->has('favoriteId'))
            ->get();

        if (count($favorite_with_same_slug) > 0) {
            $slug = Post::getNewSlug($slug, $favorite_with_same_slug);
        }

        $original = ( $request->has('original') && !empty($request->input('original')) ) ? $request->input('original') : NULL;
        $original = str_replace(url('/storage'.config('images.lists_storage_path')), '', $original);

        $thumbnail = ( $request->has('thumbnail') && !empty($request->input('thumbnail')) ) ? $request->input('thumbnail') : NULL;
        $thumbnail = str_replace(url('/storage'.config('images.lists_storage_path')), '', $thumbnail);

        $medium = ( $request->has('medium') && !empty($request->input('medium')) )  ? $request->input('medium') : NULL;
        $medium = str_replace(url('/storage'.config('images.lists_storage_path')), '', $medium);

        $favorite = Favorite::find($request->input('favoriteId'));

        // If user was attached new image - we must remove old file;
        if($favorite->original != $original){
            $path = '/public'.config('images.lists_storage_path');

            Storage::delete($path.$favorite->original);
            Storage::delete($path.$favorite->medium);
            Storage::delete($path.$favorite->thumbnail);
        }

        $favorite->name = $title;
        $favorite->slug = $slug;
        $favorite->original = $original;
        $favorite->thumbnail = $thumbnail;
        $favorite->medium = $medium;

        if($request->has('public')){
            $favorite->public = $request->input('public');
        }

        $favorite->save();

        return redirect('/favorite/edit/'.$favorite->id.'');
    }
}
