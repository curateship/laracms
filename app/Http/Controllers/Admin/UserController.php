<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('sortBy') && $request->input('sortBy') !== 'role'){
            $users = User::orderBy($request->input('sortBy'), $request->input('sortDesc'));
        }   else{
            $users = User::orderBy('id', 'ASC');
        }

        return view('admin.users.index', ['users' => $users->paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.pages.create', ['roles' => Role::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.users.pages.edit',
         [
             'roles' => Role::all(),
             'user' => User::find($id)
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->except(['_token', 'roles']));
        $user->roles()->sync($request->roles);
        $request->session()->flash('success', 'You have edited the user');

        return redirect(route('admin.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        User::destroy($id);
        $request->session()->flash('success', 'You have deleted the user');
        return redirect(route('admin.users.index'));
    }
}
