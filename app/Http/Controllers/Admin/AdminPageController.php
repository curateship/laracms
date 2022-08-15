<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Post;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class AdminPageController extends Controller
{
    //

    // List
    public function index(Request $request)
    {

        SEOMeta::setTitle(config('seotools.static_titles.'.get_called_class().'.'.__FUNCTION__));
        if($request->has('sortBy') && $request->input('sortBy') !== 'role'){
            $pages = Page::orderBy($request->input('sortBy'), $request->input('sortDesc'));
        }   else{
            $pages = Page::orderBy('created_at', 'DESC');
        }

        $status = 'All';
        if($request->has('status') && $request->input('status') != 'All'){
            $pages = $pages->where('status', strtolower($request->input('status')));
            $status = ucfirst($request->input('status'));
        }

        if($request->has('search') && $request->input('search') != ''){
            $search_input = $request->input('search');
            $pages = $pages->where(function($query) use ($search_input){
                $query->where('title', 'like', '%'.$search_input.'%')
                    ->orWhere('body', 'like', '%'.$search_input.'%');
            });
        }

        return view('admin.pages.index', [
            'pages' => $pages->paginate(10),
            'status' => $status
        ]);
    }

    // Create
    public function create()
    {
        return view('admin.pages.create');
    }

    // Show;
    public function show($any){
        $page = Page::where('slug', $any)
            ->first();

        if($page == null){
            return abort(404);
        }

        return view('admin.pages.show', [
            'page' => $page
        ]);
    }

    // Edit
    public function edit($page_slug)
    {
        $page = Page::where('slug', $page_slug)
            ->first();

        if($page == null){
            return abort(404);
        }

        // Only author or author can preview posts in draft;
        if(!Gate::allows('is-admin')){
            return abort(404);
        }

        return view('admin.pages.edit', [
            'page' => $page
        ]);
    }

    public function store(Request $request){
        $title = $request->input('title');

        // Generate slug
        $slug = Str::slug($title, '-');
        $posts_with_same_slug = Page::where('slug', 'like', $slug . '%');

        if($request->has('pageId')){
            $posts_with_same_slug = $posts_with_same_slug->where('id', '!=', $request->input('pageId'));
        }
        $posts_with_same_slug = $posts_with_same_slug->get();

        if (count($posts_with_same_slug) > 0) {
            $slug = Post::getNewSlug($slug, $posts_with_same_slug);
        }

        if(!Page::checkExitRoute($slug)){
            $slug .= '-page';
        }

        if($request->has('pageId')){
            $page = Page::find($request->has('pageId'));
        }   else{
            $page = new Page();
        }

        $page->title = $title;
        $page->body = $request->input('description');
        $page->slug = $slug;
        $page->status = $request->input('status');
        $page->save();

        return redirect('/admin/pages');
    }

    // Destroy
    public function destroy(string $ids, Request $request)
    {
        $ids = explode(',', $ids);

        foreach($ids as $id){
            Page::find($id)->delete();
        }

        $request->session()->flash('success', 'You have delete the page');
    }
}
