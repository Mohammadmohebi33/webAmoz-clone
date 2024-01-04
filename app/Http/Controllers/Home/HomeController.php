<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
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
      //  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $latestCourse = Cache::get('latestCourse');
        $popularCourse = Cache::get('popularCourse');

        if (!$latestCourse || !$popularCourse) {
            $popularCourse = Course::query()->orderByDesc('total_sales')->take(8)->get();
            Cache::put('popularCourse', $popularCourse);

            $latestCourse = Course::query()->orderByDesc('created_at')->take(8)->get();
            Cache::put('latestCourse', $latestCourse);
        }

        return view('home.main', compact('latestCourse', 'popularCourse'));
    }



    public function all()
    {
        $validatedData = request()->validate([
            'course_parameter' => 'required|in:created_at,total_sales',
        ]);
        $courses = Cache::get($validatedData['course_parameter']);
        if (!$courses){
            $courses = Course::query()->orderBy($validatedData['course_parameter'], 'desc')->paginate(12);
            Cache::put($validatedData['course_parameter'] , $courses);
        }

        return view('home.all', compact('courses'));
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

    function getVideo($path)
    {
        if (auth()->check()){
            $video = Storage::disk('local')->get("introduction_course/" . $path);
        $response = Response::make($video, 200);
        $response->header('Content-Type', 'video/mp4');
        return $response;
    }else{
            return  false;
        }
    }
}
