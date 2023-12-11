<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


trait Upload{

    public function uploadImageCourse($file, $folderName , $titleCourse)
    {
      $imagesName = [];
      $this->checkDirectory(public_path($folderName));
      $this->checkDirectory(public_path($folderName.'/'.$titleCourse));

      $data = config('filesystems.images');
      $rand =   Str::random(5);
        foreach ($data as $size){
            $fileName =$rand.'-'.$size['width'].'-'.$size['height'].'-'.$file->getClientOriginalName();
            Image::make($file)->resize($size['width'] , $size['height'])->save(public_path($folderName).'/'.$titleCourse.'/'.$fileName);
            $imagesName[] = $fileName;
        }

        return $imagesName;
    }

    public function uploadVideoCourse($file, $folderName)
    {
        $fileName = md5(auth()->user()->id) .'-'.Str::random(15).$file->clientExtension();
    //    Image::make($file)->resize(450 , 960)->save(public_path($folderName).$fileName);
        $file->move(public_path($folderName) , $fileName);
        return $fileName;
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
