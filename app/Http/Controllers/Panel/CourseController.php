<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Models\Course;
use App\Repositories\Interface\CategoryRepositoryInterface;
use App\Repositories\Interface\CourseRepositoryInterface;
use App\Traits\Upload;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Image;
use function back;
use function public_path;
use function to_route;
use function view;

class CourseController extends Controller
{
    use Upload;

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
        //validation data
        $courseData = $request->validated();
        //upload image
        $courseData['image'] = $this->uploadImageCourse($courseData['image'] , 'images' , $courseData['title']);
        //upload video
        $courseData['introduction'] = $this->uploadVideoCourse($courseData['video'] , 'introduction_course');
        //remove extra data
        unset($courseData['video']);
        //store course
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
            //remove previous image
            if ($course->image != null) {
                $previousImagePath = public_path('images') . '/' . $course->image;
                $this->removeFile($previousImagePath);
                //upload new image and update data
                $this->courseRepo->update_course($course , ['image' => $this->uploadFileCourse($courseData['image'] ,'images')]);
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
