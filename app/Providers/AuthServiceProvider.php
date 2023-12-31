<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('course_access' , function ($user, $course){
            if ($user->userHasRole('admin')){
                return true;
            }
            if ($user->id === $course->user_id){
                return true;
            }else{
                return false;
            }
        });

        Gate::define('can-comment',  function ($user, $comment){
            if ($user->userHasRole('admin')){
                return true;
            }
            if ($user->id === $comment->course->user_id){
                return true;
            }else{
                return false;
            }
        });
    }
}
