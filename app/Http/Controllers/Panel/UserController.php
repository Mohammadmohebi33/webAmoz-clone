<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use App\Repositories\Interface\UserRepositoryInterface;
use App\Traits\Upload;
use function collect;
use function request;
use function to_route;
use function view;

class UserController extends Controller
{
    use Upload;

    private $userRepo;
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->middleware('isAdmin');
        $this->userRepo = $userRepository;
    }


    public function index()
    {
        $users = collect([]);
        if (request()->has('roles')){
            foreach (request()->roles as $role){
                $roleUsers = $this->userRepo->getUserWithRole($role);
                $users = $users->merge($roleUsers)->unique('id');;
            }
            return view('panel.users.index' , compact('users'));
        }

        $users = $this->userRepo->all();
        return view('panel.users.index' , compact('users'));
    }




    public function trashed()
    {
        $users = $this->userRepo->userTrashed();
        return view('panel.users.deleted' , compact('users'));
    }


    public function restore($user)
    {
        $this->userRepo->restore($user);
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
        $this->userRepo->store($request->validated());
        return to_route('users')->with('message' , 'user create successfully');
    }



    public function update(UserRequest $request, User $user)
    {
        $userData = $request->validated();

        if(!isset($userData['image'])){
            $this->userRepo->update($user, $userData);
        }else{
            $userData['image'] =  $this->uploadFileCourse($userData['image'] , 'dist/img');
            $this->userRepo->update($user, $userData);
        }

        return to_route('users');
    }



    public function destroy(User $user)
    {
       $this->userRepo->destroy($user);
       return to_route('users');
    }
}
