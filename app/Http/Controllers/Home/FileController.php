<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use function public_path;
use function response;

class FileController extends Controller
{

    public function download($file_name , $dir) {
        if (!auth()->check()){
            return back()->with('swal-error' , 'برای دسترسی ابتدا لاگین کنید.');
        }
//        $test = auth()->user()->purchase;
//        foreach ($test as $vel){
//            dd($vel['course_id']);
//        }
//        dd($test['course_id']);
      //  $file_path = public_path($dir.'/'.$file_name);
      //  return response()->download($file_path);

        return response()->json(['file_url' => $file_name]);
    }

}
