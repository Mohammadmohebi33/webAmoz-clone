<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CourseController extends Controller
{

    public function __construct()
    {
        $this->middleware('isAdmin')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->userHasRole('admin')){
            $courses = Course::all();
        }else{
            $courses = auth::user()->courses;
        }
        return view('panel.course.index' , compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->whereNotNull('parent_id')->get();
        return view('panel.course.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->check()) {
            //  return redirect()->route('login')->with('message', 'You need to login first!');
            return back()->with('fail' , 'You need to login first!');
        }

        $courseData = $request->validate([
            'title' => ['required' , 'min:4' , "max:60"],
            'status' => ['required'],
            'isCompleted' => ['required'],
            'price' => ['required'],
            'description' => ['required'],
            'image' => ['required','mimes:jpeg,png,jpg'],
            'video' => ['required','mimes:mp4,mov,ogg,qt','max:2000000']
        ]);

        //upload image
        $image = $courseData['image'];
        $fileName = md5(auth()->user()->id) .'-'.Str::random(15).$image->clientExtension();
        $image->move(public_path('images') , $fileName);

        //upload  introduction video
        $video = $courseData['video'];
        $videoName = md5($courseData['title']) .'-'.Str::random(15);
        $video->move(public_path('introduction_course') , $videoName);

        $course = auth()->user()->courses()->create([
            'title' => $courseData['title'],
            'status' => $courseData['status'],
            'isCompleted' => $courseData['isCompleted'],
            'price' => $courseData['price'],
            'description' => $courseData['description'],
            'introduction' => $videoName,
            'image' => $fileName
        ]);


        if ($request->has('category')){
            $course->categories()->syncWithoutDetaching($request->category);
        }

        return to_route('course.index')->with('message' , 'course create successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $this->authorize('update-course' , $course);
        $sessions = $course->episodes()->latest()->get();
        return view('panel.course.show' , compact('course' , 'sessions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $this->authorize('update-course' , $course);
        $categories = Category::query()->whereNotNull('parent_id')->get();
        return view('panel.course.edit' , compact('course' , 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $this->authorize('update-course' , $course);
        $courseData = $request->validate([
            'title' => ['required' , 'min:4' , "max:60"],
            'status' => ['required'],
            'isCompleted' => ['required'],
            'price' => ['required'],
            'description' => ['required'],
            'image' => ['nullable','mimes:jpeg,png,jpg'],
        ]);


        $course->update([
            'title' => $courseData['title'],
            'status' => $courseData['status'],
            'isCompleted' => $courseData['isCompleted'],
            'price' => $courseData['price'],
            'description' => $courseData['description'],
        ]);

        if ($request->hasFile('image')) {
            $image = $courseData['image'];
            $fileName = md5($course->user_id) . '-' . Str::random(15) . $image->clientExtension();

            //remove previous image
            $previousImage = $course->image;
            if ($previousImage) {
                $previousImagePath = public_path('images') . '/' . $previousImage;
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }

                $image->move(public_path('images'), $fileName);
                $course->update(['image' => $fileName]);
            }
        }

        if ($request->has('category')){
            $course->categories()->detach();
            $course->categories()->syncWithoutDetaching($request->category);
        }

        return to_route('course.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return back();
    }
}
