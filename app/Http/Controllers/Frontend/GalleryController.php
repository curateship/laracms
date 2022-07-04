<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Post;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class GalleryController extends Controller
{
    //
    public function index(Request $request)
    {

        SEOMeta::setTitle(config('seotools.static_titles.'.get_called_class().'.'.__FUNCTION__));
        if($request->has('sortBy') && $request->input('sortBy') !== 'role'){
            $galleries = Gallery::orderBy($request->input('sortBy'), $request->input('sortDesc'));
        }   else{
            $galleries = Gallery::orderBy('created_at', 'DESC')->whereNotNull('user_id');
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

        $galleries = $galleries->where('user_id', Auth::id());

        return view('admin.galleries.index', [
            'galleries' => $galleries->paginate(10),
            'status' => $status
        ]);
    }

    public function show(Request $request, Gallery $gallery){
        // Only author or author can preview posts in draft;
        if($gallery->status == 'draft'){
            if(!Gate::allows('is-admin') && (!Auth::guest() && Auth::id() != $gallery->user_id)){
                return abort(404);
            }
        }

        // SEO Title
        SEOMeta::setTitle($gallery->title);

        $gallery->author = $gallery->author();

        $posts = DB::table('galleries_posts')
            ->leftJoin('posts', 'posts.id', '=', 'galleries_posts.post_id')
            ->where('gallery_id', $gallery->id)
            ->select('posts.*')
            ->get();

        return view('/theme.galleries.gallery', [
            'gallery' => $gallery,
            'posts' => $posts
        ]);
    }

    // Create
    public function create()
    {
        return view('admin.galleries.create');
    }
}
