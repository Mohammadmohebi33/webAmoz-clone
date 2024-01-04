<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
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


    public function update(Request $request)
    {
        $fileName = null;

        if ($request->hasFile('image')){
            $rand = Str::random(5);
            $fileName = $rand.$request->file('image')->getClientOriginalName();
            $img= Image::make($request->file('image'))->resize(550 , 450)->encode();
            Storage::drive('public')->put('user/'.$fileName , $img);
        }
      auth()->user()->update([
          'name' => $request->name,
          'about_me' => $request->about_me,
          'image' => $fileName != null ? $fileName : auth()->user()->image ,
      ]);

        return back();
    }


    public function myComment(){
        $comments = auth()->user()->comments()->latest()->get();
        return view('profile.comments' , compact('comments'));
    }


    public function getCourse(){
        $courses = auth()->user()->courseUser;
        return view('profile.myCourse' , compact('courses'));
    }
}
