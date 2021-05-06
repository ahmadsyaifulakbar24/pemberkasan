<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Image;

class FileHelpers {

    public static function upload_image_resize($image, $file_name) {
// Resize image
        $resize = Image::make($image)->resize(600, null, function ($constraint) {
            $constraint->aspectRatio();
        })->encode('jpg');

        // Put image to storage
        $path = "file_manager/{$file_name}";
        $save = Storage::put("public/{$path}", $resize->__toString());
        if($save) {
            return $path;
        } else {
            return false;
        } 
    }

    public static function upload_file($path, $file)
    {
        $couter = 0;
        $name_of_upload = $file->getClientOriginalName();
        $original_name = pathinfo($name_of_upload, PATHINFO_FILENAME);
        $ext = $file->getClientOriginalExtension();

        if($file->isValid()) {
            while(Storage::disk('public')->exists($path.'/'.$name_of_upload)) {
                $couter++;
                $name_of_upload = $original_name." (".$couter.").".$ext;
            }
            $path = $file->storeAs($path, $name_of_upload, 'public');
            return $path;
        }
    }
}