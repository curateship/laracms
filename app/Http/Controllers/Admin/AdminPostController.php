<?php

namespace App\Http\Controllers\Admin;

// Others
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

// Models
use App\Models\Category;
use App\Models\Post;
use App\Models\Image;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class AdminPostController extends Controller
{
    // Index
    public function index(Request $request)
    {
        if($request->has('sortBy') && $request->input('sortBy') !== 'role'){
            $posts = Post::orderBy($request->input('sortBy'), $request->input('sortDesc'));
        }   else{
            $posts = Post::orderBy('created_at', 'DESC');
        }

        return view('admin.posts.index', [
            'posts' => $posts->paginate(10),
        ]);
    }

    // Create
    public function create()
    {
        return view('admin.posts.create', [
        'categories' => Category::pluck('name', 'id')
        ]);
    }

    // Store
    public function store(Request $request)
    {
        dd($request->all());
    }

    public function show($id)
    {
        //
    }

    // Edit
    public function edit(Post $post)
    {

        return view('admin.posts.edit', [
            'post' => $post,
            'categories' => Category::pluck('name', 'id')
        ]);
    }

    // Update
    public function update(Request $request, $id)
    {
        //
    }

    // Destroy
    public function destroy(string $ids, Request $request)
    {
        $ids = explode(',', $ids);

        foreach($ids as $id){
            // Remove tags links;
            DB::table('post_tag')
                ->where('post_id', $id)
                ->delete();

            // And then - remove the post;
            Post::destroy($id);
        }

        if(count($ids) > 1){
            $request->session()->flash('success', 'You have deleted all selected posts');
        }   else{
            $request->session()->flash('success', 'You have deleted the post');
        }
    }
}
