<?php

namespace App\Http\Controllers\Admin;

// Others
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Category;
use App\Models\Post;
use App\Models\Image;
use App\Models\User;
use App\Models\Role;

class AdminPostController extends Controller
{
    // Index
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::with('category')->orderBy('id', 'DESC')->paginate(10),
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
    public function destroy($id)
    {
        //
    }
}
