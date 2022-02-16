<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;

class AdminCommentController extends Controller
{
    private $rules = [
        'post_id' => 'required|numeric',
        'the_comment' => 'required|min:5|max:1000'
    ];

    // Index
    public function index()
    {
        return view('admin.comments.index', [
            'comments' => Comment::latest()->paginate(50)
        ]);
    }
    
    // Create
    public function create()
    {
        return view('admin.comments.create', [
            'posts' => Post::pluck('title', 'id')
        ]);
    }

    // Store
    public function store(Request $request)
    {
        $validated = $request->validate($this->rules);
        $validated['user_id'] = auth()->id();

        Comment::create($validated);
        return redirect()->route('admin.comments.create')->with('success', 'Comment has been added.');
    }

    // Edit
    public function edit(Comment $comment)
    {
        return view('admin.comments.edit', [
            'posts' => Post::pluck('title', 'id'),
            'comment' => $comment
        ]);
    }

    // Update
    public function update(Request $request, Comment $comment)
    {
        $validated = $request->validate($this->rules);
        $comment->update($validated);
        return redirect()->route('admin.comments.edit', $comment)->with('success', 'Comment has been updated.');
    }
    
    // Destroy
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('admin.comments.index')->with('success', 'Comment has been deleted.');
    }
}