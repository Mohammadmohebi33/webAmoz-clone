<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Category;
use App\Models\Course;
use App\Repositories\Interface\CategoryRepositoryInterface;
use App\Repositories\Interface\CourseRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CourseController extends Controller
{

    private $courseRepo;
    private $categoryRepo;

    public function __construct(CourseRepositoryInterface $courseRepo , CategoryRepositoryInterface $categoryRepo)
    {
        $this->middleware('isAdmin')->only(['destroy']);
        $this->courseRepo = $courseRepo;
        $this->categoryRepo = $categoryRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->userHasRole('admin')){
          $courses =  $this->courseRepo->all();
        }else{
           $courses = $this->courseRepo->get_auth_user_courses();
        }
        return view('panel.course.index' , compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryRepo->getChildCategory();
        return view('panel.course.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseRequest $request)
    {
        $courseData = $request->validated();
        //upload image
        //TODO refactor to upload file
        $image = $courseData['image'];
        $fileName = md5(auth()->user()->id) .'-'.Str::random(15).$image->clientExtension();
        $courseData['image'] = $fileName;
        $image->move(public_path('images') , $fileName);

        //upload  introduction video
        //TODO refactor to upload file
        $video = $courseData['video'];
        $videoName = md5($courseData['title']) .'-'.Str::random(15);
        $courseData['introduction'] = $videoName;
        unset($courseData['video']);
        $video->move(public_path('introduction_course') , $videoName);

        $this->courseRepo->storeCourse($courseData);
        return to_route('course.index')->with('message' , 'course create successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $this->authorize('course_access' , $course);
        $episodes = $this->courseRepo->get_episode($course);
        return view('panel.course.show' , compact('course' , 'episodes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $this->authorize('course_access' , $course);
        $categories = $this->categoryRepo->getChildCategory();
        return view('panel.course.edit' , compact('course' , 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseRequest $request, Course $course)
    {
        $this->authorize('course_access' , $course);
        $courseData = $request->validated();
        $this->courseRepo->update_course($course, $courseData);

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
                $this->courseRepo->update_course($course , ['image' => $fileName]);
            }
        }

        return to_route('course.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $this->courseRepo->destroy($course);
        return back();
    }
}
