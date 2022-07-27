<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    //
    public function index(Request $request)
    {

        SEOMeta::setTitle(config('seotools.static_titles.'.get_called_class().'.'.__FUNCTION__));
        if($request->has('sortBy') && $request->input('sortBy') !== 'role'){
            $galleries = Post::orderBy($request->input('sortBy'), $request->input('sortDesc'));
        }   else{
            $galleries = Post::orderBy('created_at', 'DESC')->whereNotNull('user_id');
        }

        $status = 'All';
        if($request->has('status') && $request->input('status') != 'All'){
            $galleries = $galleries->where('status', strtolower($request->input('status')));
            $status = ucfirst($request->input('status'));
        }

        if($request->has('search') && $request->input('search') != ''){
            $search_input = $request->input('search');
            $galleries = $galleries->where(function($query) use ($search_input){
                $query->where('title', 'like', '%'.$search_input.'%')
                    ->whereOr('description', 'like', '%'.$search_input.'%');
            });
        }

        $galleries = $galleries->where('user_id', Auth::id())
            ->where('type', 'gallery');

        return view('admin.posts.index', [
            'posts' => $galleries->paginate(10),
            'status' => $status
        ]);
    }

    public function mangeAjax(Request $request){
        $post = Post::find($request->input('post_id'));

        $images = Storage::allFiles('/public/'.config('images.galleries_storage_path').'/'.$post->slug.'/original/');
        $result = '';
        foreach($images as $key => $image){
            $image = str_replace('public/', '/', $image);
            if($key + 1 == $request->input('current')){
                $result = '<img class="manga-image" src="/storage'.$image.'" />';
            }
        }

        return [
            'total' => count($images),
            'length' => 1,
            'size' => 5,
            'data' => $result
        ];
    }
}
