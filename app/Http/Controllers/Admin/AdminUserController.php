<?php

namespace App\Http\Controllers\Admin;

// Others
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;

// Supports
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

// Models
use App\Models\Post;
use App\Models\User;
use App\Models\Role;

class AdminUserController extends Controller
{
    // Index
    public function index(Request $request)
    {
        if($request->has('sortBy') && $request->input('sortBy') !== 'role'){
            $users = User::orderBy($request->input('sortBy'), $request->input('sortDesc'));
        }   else{
            $users = User::orderBy('created_at', 'DESC');
        }

        if(Gate::denies('logged-in')){
            dd('no access allowed');
        }

        if(Gate::allows('is-admin')){
            return view('admin.users.index', ['users' => $users->paginate(10)]);
        }

        dd('You need to be Admin');

    }

    // Create
    public function create()
    {
        return view('admin.users.create', ['roles' => Role::all()]);
    }

    // Store
    public function store(StoreUserRequest $request)
    {
        $validedData = $request->validated();
        $user = User::create($request->except(['_token', 'roles']));
        $request->session()->flash('success', 'You have created the user');

        $roles = [];
        foreach($request->roles as $role_id){
            $roles[] = [
                'role_id' => $role_id
            ];
        }
        if(count($roles) > 0){
            $user->roles()->sync($roles);
        }

        return redirect(route('admin.users.index'));
    }

    // Edit
    public function edit($id)
    {
        return view('admin.users.edit',
         [
             'roles' => Role::all(),
             'user' => User::find($id)
            ]);
    }

    // Update
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->except(['_token', 'roles']));
        $user->roles()->sync($request->roles);
        $request->session()->flash('success', 'You have edited the user');

        return redirect(route('admin.users.index'));
    }

    // Destroy
    public function destroy(string $ids, Request $request)
    {
        $ids = explode(',', $ids);

        foreach($ids as $id){
            // Getting all user posts;
            $posts = Post::where('user_id', $id)
                ->update([
                    'user_id' => null
                ]);

            // And then - remove the user;
            User::destroy($id);
        }

        if(count($ids) > 1){
            $request->session()->flash('success', 'You have deleted all selected users');
        }   else{
            $request->session()->flash('success', 'You have deleted the user');
        }
    }

    // Theme Switcher
    public function saveTheme(Request $request){
        $user = User::find(Auth::id());
        $user->theme = $request->input('theme');
        $user->save();
    }
}
