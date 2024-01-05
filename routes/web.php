<?php

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\ProfileController;
use App\Models\Course;
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
Route::get('/all' , [HomeController::class , 'all'])->name('all');
Route::get('/course/{course}' , [HomeController::class , 'show'])->name('show');
Route::get('/profile' , [ProfileController::class , 'getMe'])->name('getMe');



Route::post('/purchase', function (Request $request){
    $data = $request->validate([
        "price" => "integer",
        "course_id" => "required",
        "course_title" => "required",
    ]);


    return getPayment($data);
})->name('purchase');



Route::get('/redirectBack',function (Request $request){
    $status = $request->input('status');
    $token = $request->input('token');

    if ($status == 1)
    {
        $detail = verifyPayment($token);

        if ($detail["message"] == "success")
        {
            return view('home.redirectBack', compact('detail'));
        }
    }
});




Route::get('/download/{file}/{dir}' , [\App\Http\Controllers\Home\FileController::class , 'download'])->name('download.file');
Route::get('/get-video/{path}', [HomeController::class , 'getVideo'])->name('getVideo');


Route::prefix('/profile')->group(function (){
    Route::get('/' , [ProfileController::class , 'getMe'])->name('profile.index');
    Route::put('/' , [ProfileController::class , 'update'])->name('profile.update');
    Route::get('/myCourse' , [ProfileController::class , 'getCourse'])->name('profile.course');
    Route::get('/myComments' , [ProfileController::class , 'myComment'])->name('profile.comment');
});


