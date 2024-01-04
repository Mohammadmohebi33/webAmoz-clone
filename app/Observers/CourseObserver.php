<?php

namespace App\Observers;

use App\Models\Course;
use Illuminate\Support\Facades\Cache;

class CourseObserver
{
    /**
     * Handle the Course "created" event.
     */
    public function created(Course $course): void
    {
        if (request()->input('category') != null){
            $course->categories()->syncWithoutDetaching(request()->input('category'));
        }

        Cache::forget('latestCourse');
        Cache::forget('popularCourse');
        Cache::forget('total_sales');
        Cache::forget('created_at');
    }

    /**
     * Handle the Course "updated" event.
     */
    public function updated(Course $course): void
    {
        if (request()->input('category') != null){
            $course->categories()->detach();
            $course->categories()->syncWithoutDetaching(request()->input('category'));
        }
    }

    /**
     * Handle the Course "deleted" event.
     */
    public function deleted(Course $course): void
    {
        Cache::forget('latestCourse');
        Cache::forget('popularCourse');
        Cache::forget('total_sales');
        Cache::forget('created_at');
    }

    /**
     * Handle the Course "restored" event.
     */
    public function restored(Course $course): void
    {
        //
    }

    /**
     * Handle the Course "force deleted" event.
     */
    public function forceDeleted(Course $course): void
    {
        //
    }
}
