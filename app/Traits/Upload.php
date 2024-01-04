<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


trait Upload{

    public function uploadImageCourse($file, $folderName , $titleCourse)
    {
      $imagesName = [];

        $this->checkDirectory(storage_path('app/'.$folderName));
        $this->checkDirectory(storage_path('app/'.$folderName.'/'.$titleCourse));

      $data = config('filesystems.images');
      $rand = Str::random(5);
        foreach ($data as $size){
            $fileName = $rand.'-'.$size['width'].'-'.$size['height'].'-'.$file->getClientOriginalName();
            $img= Image::make($file)->resize($size['width'] , $size['height'])->encode();
            Storage::drive('public')->put($folderName.'/'.$titleCourse.'/'.$fileName , $img);
            $imagesName[] = $fileName;
        }
        return $imagesName;
    }



    public function uploadVideoCourse($file, $folderName)
    {
     //   $fileName = md5(auth()->user()->id) .'-'.Str::random(5);
        Storage::put($folderName, $file);
        return $file->hashName();
    }



    protected function checkDirectory($imageDirectory)
    {
        if(!file_exists($imageDirectory))
        {
            mkdir($imageDirectory, 0755, true);
        }
    }


    public function removeFile($path)
    {
        if (file_exists($path)) {
            unlink($path);
        }
    }
}
