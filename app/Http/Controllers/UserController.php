<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('isAdmin');
    }


    public function index()
    {
        $users=[];

        if (request()->has('roles')){
            foreach (request()->roles as $role){
                if (in_array($role, Role::query()->pluck('role_name')->toArray())){
                    $roleUsers = Role::query()->where('role_name', $role)->first()->users;
                    $users = array_merge($users, $roleUsers->all());
                }
            }

            $emails = array_column($users, 'email');
            $uniqueEmails = array_unique($emails);

            $uniqueUsers = [];
            foreach ($users as $user) {
                if (in_array($user['email'], $uniqueEmails)) {
                    $uniqueUsers[] = $user;
                    unset($uniqueEmails[array_search($user['email'], $uniqueEmails)]);
                }
            }
            return view('panel.users.index' , compact('uniqueUsers'));
        }


        $uniqueUsers = User::all();
        return view('panel.users.index' , compact('uniqueUsers'));
    }




    public function trashed()
    {
        $uniqueUsers = User::onlyTrashed()->get();
        return view('panel.users.deleted' , compact('uniqueUsers'));
    }


    public function restore($user)
    {
        User::query()->where('id', $user)->withTrashed()->restore();
        return to_route('users');
    }



    public function show(User $user)
    {
        $roles = Role::all();
        return view('panel.users.update' , compact('user' , 'roles'));
    }




    public function create()
    {
        $roles = Role::all();
        return view('panel.users.create', compact('roles'));
    }




    public function store(UserRequest $request)
    {
        $user = User::query()->create($request->validated());
        $user->roles()->syncWithoutDetaching($request->roles);
        return to_route('users')->with('message' , 'user create successfully');
    }



    public function update(UserRequest $request, User $user)
    {
        $data = $request->validated();
        $user->update([
            'name' => $data['name'],
            'status' => $data['status'],
            'about_me' => $data['about_me']
        ]);

        $user->roles()->detach();
        $user->roles()->syncWithoutDetaching($request->roles);

        return to_route('users');
    }



    public function destroy(User $user)
    {
        $user->status = 'disable';
        $user->delete();
        $user->save();
        return to_route('users');
    }
}
