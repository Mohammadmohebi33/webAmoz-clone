<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use function auth;
use function dd;
use function view;

class ProfileController extends Controller
{
    public function getMe()
    {
        $authUser = auth()->user();
        return view('profile.info' , compact('authUser'));
    }


    public function myComment(){
        $comments = auth()->user()->comments()->latest()->get();
        return view('profile.' , compact('comments'));
    }


    public function myCourse(){
        dd("ok");
//        $courses = auth()->user()->
    }
}
