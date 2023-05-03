<?php

namespace App\Http\Traits;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;


trait imageTrait
{
    public function img(Request $request, $image = "image")
    {
        if ($request->hasFile("$image")) {
            $name = time() . "_" . rand(10000, 99999) . "." . $request->file("$image")
                    ->getClientOriginalExtension();
            $request->file("$image")->move("uploads/", $name);
        }
        return 'uploads/' . $name;
    }

//    public function vidoe(Request $request, $video = "video")
//    {
//        if ($request->hasFile("$video")) {
//            $name = time() . "_" . rand(10000, 99999) . "." . $request->file("$video")
//                    ->getClientOriginalExtension();
//            $request->file("$video")->move("uploads/", $name);
//        }
//        return 'uploads/' . $name;
//    }

    public function storeImage($image, $fileName, $oldImageName = null, $width = 512, $height = null)
    {
        if ($image) {
            $extention = $image->getClientOriginalExtension();
            $image_name = time() . "" . rand(1000000, 9999999) . "" . time() . "_" . rand(1000000, 9999999) . "." . $extention;
            if (!File::exists("uploads/$fileName")) {
                File::makeDirectory("uploads/$fileName");
            }
            if ($height == null) {
                Image::make($image)->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                })->save("uploads/$fileName/$image_name");
                if ($oldImageName != null) {
                    unlink('uploads/' . $fileName . '/' . $oldImageName);
                }
            } else {
                Image::make($image)->resize($width, $height)->save("uploads/$fileName/$image_name");
                if ($oldImageName != null) {
                    unlink('uploads/' . $fileName . '/' . $oldImageName);
                }
            }
            return $image_name;
        } else {
            return '';
        }
    }

}
