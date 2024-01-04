<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CourseController extends Controller
{
    public function popularCourse()
    {
        $popularCourse = Course::query()->orderByDesc('total_sales')->take(8)->get();
        return $popularCourse;
    }



    public function  latestCourse()
    {
        $latestCourse = Course::query()->orderByDesc('created_at')->take(8)->get();
        return $latestCourse;
    }

}
