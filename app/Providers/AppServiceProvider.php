<?php

namespace App\Providers;

use App\Repositories\Interface\CategoryRepositoryInterface;
use App\Repositories\Interface\CourseRepositoryInterface;
use App\Repositories\EloquentMysql\CategoryRepository;
use App\Repositories\EloquentMysql\CourseRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CourseRepositoryInterface::class , CourseRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class , CategoryRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
