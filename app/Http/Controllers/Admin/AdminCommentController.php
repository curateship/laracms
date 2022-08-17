<?php

namespace App\Http\Controllers\Admin;

// Others
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
            $comments = Comment::orderBy('created_at', 'DESC')
                ->selectRaw('comments.*')
                ->leftJoin('users', 'users.id', '=', 'comments.user_id');
        }

        if(!Gate::allows('is-admin')){
            $comments = $comments->where('user_id', Auth::id());
        }

        return view('admin.comments.index', ['comments' => $comments->paginate(10)]);
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
    public function edit($id)
    {
        $comment = Comment::find($id);

        if($comment == null){
            return abort(404);
        }

        if(!Gate::allows('is-admin') && $comment->user_id != Auth::id()){
            return abort(404);
        }

        return view('admin.comments.edit', [
            'comment' => $comment
        ]);
    }

    // Update
    public function update(Request $request)
    {
        $comment = Comment::find($request->input('commentId'));

        if($comment == null){
            return abort(404);
        }

        if(!Gate::allows('is-admin') && $comment->user_id != Auth::id()){
            return abort(404);
        }

        $comment->the_comment = $request->input('the_comment');
        $comment->save();

        return redirect()->route('comments.edit', $comment)->with('success', 'Comment has been updated.');
    }

    // Destroy
    public function destroy(string $ids, Request $request)
    {
        $ids = explode(',', $ids);

        foreach($ids as $id){
            // Destroy comment replays;
            Comment::where('reply_id', $id)
                ->delete();

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
