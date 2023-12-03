<?php

namespace App\Repositories\EloquentMysql;


use App\Models\Role;
use App\Models\User;
use App\Repositories\Interface\UserRepositoryInterface;


class  UserRepository implements UserRepositoryInterface {

    public function all()
    {
        return User::all();
    }

    public function getUserWithRole($roleName)
    {
       return Role::query()->where('role_name', $roleName)->first()->users;
    }

    public function userTrashed()
    {
       return User::onlyTrashed()->get();
    }

    public function restore($id)
    {
        User::query()->where('id', $id)->withTrashed()->restore();
    }

    public function store($data)
    {
       User::create($data);
    }

    public function update($user , $data)
    {

    }

    public function destroy($user)
    {
        $user->status = 'disable';
        $user->delete();
        $user->save();
    }
}
