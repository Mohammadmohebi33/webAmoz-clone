<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use function public_path;
use function response;

class FileController extends Controller
{

    public function download($file_name , $dir) {
        if (!auth()->check()){
            //TODO
        }
        $file_path = public_path($dir.'/'.$file_name);
        return response()->download($file_path);
    }

}
