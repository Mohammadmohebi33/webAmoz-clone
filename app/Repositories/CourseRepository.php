<?php


namespace App\Repositories;

use App\Models\Course;
use App\Repositories\Interface\CourseRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CourseRepository implements CourseRepositoryInterface {


    public function all()
    {
        return Course::all();
    }

    public function get_auth_user_courses()
    {
         return auth::user()->courses;
    }

    public function storeCourse($data)
    {
      return auth()->user()->courses()->create($data);
    }

    public function get_episode(Course $course)
    {
       return $course->episodes()->latest()->get();
    }

    public function update_course($course, $data)
    {
       return $course->update($data);
    }

    public function destroy($course)
    {
        $course->delete();
    }
}
