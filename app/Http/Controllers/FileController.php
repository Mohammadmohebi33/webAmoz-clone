<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{

    public function download($file_name) {
        $file_path = public_path('introduction_course/'.$file_name);
        return response()->download($file_path);
    }
}
