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
    public function index(Request $request)
    {
        if($request->has('sortBy') && $request->input('sortBy') !== 'role'){
            $comments = Comment::orderBy($request->input('sortBy'), $request->input('sortDesc'));
        }   else{
            $comments = Comment::orderBy('created_at', 'DESC');
        }

        return view('admin.comments.index', ['comments' => $comments->paginate(10)]);
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
    public function destroy(string $ids, Request $request)
    {
        $ids = explode(',', $ids);

        foreach($ids as $id){
            // And then - remove the comment;
            Comment::destroy($id);
        }

        if(count($ids) > 1){
            $request->session()->flash('success', 'You have deleted all selected comments');
        }   else{
            $request->session()->flash('success', 'You have deleted the comment');
        }
    }
}
