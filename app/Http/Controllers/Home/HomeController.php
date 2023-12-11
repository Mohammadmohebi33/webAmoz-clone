<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use function view;

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
        $popularCourse = Course::query()->orderByDesc('total_sales' )->take(8)->get();
        $latestCourse = Course::query()->orderByDesc('created_at')->take(8)->get();
        return view('home.main' , compact('latestCourse' , 'popularCourse'));
    }



    public function show(Course $course)
    {
        $comments = $course->comments()->where('status' , 'active')->where('parent_id' , null)->latest()->get();
        $totalTime = 0;
        foreach ($course->episodes as $session){
            $totalTime += $session->time;
        }

        return view('home.show' , compact('course','comments' , 'totalTime'));
    }
}
