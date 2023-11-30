<?php

namespace App\Repositories\Interface;



use App\Models\Course;

interface CourseRepositoryInterface{

    public function all();
    public function get_auth_user_courses();
    public function storeCourse($data);
    public function get_episode(Course $course);
    public function update_course($course , $data);
    public function destroy($course);
}
