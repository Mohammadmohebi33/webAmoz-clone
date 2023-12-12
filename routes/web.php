<?php

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\ProfileController;
use App\Http\Controllers\Panel\CategoryController;
use App\Http\Controllers\Panel\CommentController;
use App\Http\Controllers\Panel\CourseController;
use App\Http\Controllers\Panel\EpisodeController;
use App\Http\Controllers\Panel\RoleController;
use App\Http\Controllers\Panel\UserController;
use App\Models\Course;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Auth::routes();


Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/all/{course_parameter}' , [HomeController::class , 'all'])->name('all');
Route::get('/course/{course}' , [HomeController::class , 'show'])->name('show');
//Route::get('/profile' , [ProfileController::class , 'getMe'])->name('getMe');

Route::prefix('/profile')->group(function (){
    Route::get('info',  [ProfileController::class , 'getMe']);
    Route::get('myCourse',  [ProfileController::class , 'myCourse']);
    Route::get('myComment',  [ProfileController::class , 'myComment']);
});

Route::post('/purchase', function (Request $request){

    Purchase::create([
        'user_id' => auth()->user()->id,
        'course_id' => $request->course_name,
    ]);

    $course = Course::query()->find($request->course_name);
    $course->update([
        'total_sales' => $course->total_sales  + 1
    ]);

    return back();
})->name('purchase');


Route::prefix('/panel')->middleware(['auth' , 'hasRole'])->group(function (){


    Route::prefix('user')->group(function (){
        Route::get('/' , [UserController::class , 'index'])->name('users');
        Route::get('/show/{user}', [UserController::class, 'show'])->name('showUser');
        Route::get('/create' , [UserController::class , 'create'])->name('createUser');
        Route::get('/deleted', [UserController::class, 'trashed'])->name('deletedUser');
        Route::post('/store', [UserController::class ,'store'])->name('storeUser');
        Route::post('/{user}/restore', [UserController::class , 'restore'])->name('users.restore');
        Route::patch('/update/{user}' , [UserController::class , 'update'])->name('updateUser');
        Route::delete('/delete/{user}' , [UserController::class ,'destroy'])->name('deleteUser');
    });
    Route::prefix('role')->group(function (){
        Route::get('/' , [RoleController::class , 'index'])->name('roles');
        Route::get('create' , [RoleController::class , 'create'])->name('createRole');
        Route::post('store' , [RoleController::class , 'store'])->name('storeRole');
        Route::delete('/{role}', [RoleController::class, 'destroy'])->name('destroyRole');
    });
    Route::prefix('category')->group(function (){
        Route::get('/' , [CategoryController::class , 'index'])->name('category.index');
        Route::get('/{category}',  [CategoryController::class , 'show'])->name('category.show');
        Route::post('/create', [CategoryController::class , 'store'])->name('category.store');
        Route::patch('/update/{category}' , [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/{category}', [CategoryController::class , 'destroy'])->name('category.delete');
        Route::get('/status/{category}' , [CategoryController::class , 'status'])->name('category.status');
    });
    Route::prefix('comment')->group(function (){
        Route::post('/' , [CommentController::class , 'store'])->name('comment.store');
        Route::get('/activeComment' , [CommentController::class , 'activeComments'])->name('activeComment.store');
        Route::get('/rejectComment' , [CommentController::class , 'rejectComments'])->name('rejectComment.store');
        Route::get('/allComments' , [CommentController::class , 'index'])->name('comment.index');
        Route::post('/changeStatus/{comment}/{status}' , [CommentController::class , 'changeStatus'])->name('comment.status');
    });
    Route::prefix('episodes')->group(function (){
        Route::get('/course/sessions/{course}' , [EpisodeController::class , 'showCourseSessions'])->name('course.sessions');
        Route::get('/' , [EpisodeController::class , 'index'])->name('episodes.index');
        Route::delete('/{episodes}' , [EpisodeController::class , 'destroy'])->name('episodes.destroy');
        Route::get('/{episodes}/edit' , [EpisodeController::class , 'edit'])->name('episodes.edit');
        Route::get('/episodes/create' , [EpisodeController::class,  'create'])->name('episodes.create');
        Route::post('/episodes/store' , [EpisodeController::class , 'store'])->name('episodes.store');
        Route::match(['put', 'patch'] ,'/episodes/{episodes}/update',  [EpisodeController::class, 'update'])->name('episodes.update');
    });
    Route::resource('course' , CourseController::class);

    Route::get('/' , function (){return view('panel.index');})->name('panel');
});

Route::get('/download/{file}/{dir}' , [\App\Http\Controllers\Home\FileController::class , 'download'])->name('download.file');


