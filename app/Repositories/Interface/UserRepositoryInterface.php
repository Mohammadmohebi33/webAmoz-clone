<?php


namespace App\Repositories\Interface;


interface UserRepositoryInterface{


    public function all();
    public function getUserWithRole($roleName);
    public function userTrashed();
    public function restore($id);
    public function store($data);
    public function update($user,$data);
    public function destroy($user);
}
