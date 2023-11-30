<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Upload{

    public function uploadFileCourse($file, $folderName)
    {
        $fileName = md5(auth()->user()->id) .'-'.Str::random(15).$file->clientExtension();
        $file->move(public_path($folderName) , $fileName);
        return $fileName;
    }



    public function removeFile($path)
    {
        if (file_exists($path)) {
            unlink($path);
        }
    }
}
