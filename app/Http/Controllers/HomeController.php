<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $courses = Course::query()->paginate(9);
        return view('home.courses' , compact('courses'));
    }



    public function show(Course $course)
    {
        $comments = $course->comments()->where('status' , 'active')->latest()->get();
        $totalTime = 0;
        foreach ($course->episodes as $session){
            $totalTime += $session->time;
        }

        return view('home.show' , compact('course','comments' , 'totalTime'));
    }
}
