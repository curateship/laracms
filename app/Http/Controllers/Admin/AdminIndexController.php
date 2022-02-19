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

class AdminIndexController extends Controller
{
    // Index
    public function index()
    {
        return view('admin.dashboard.index', [
            'posts' => Post::with('category')->orderBy('id', 'DESC')->get(),
        ]);
    }

    // Create
    public function create()
    {
       
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
        
        return view('admin.posts.pages.edit', [
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
