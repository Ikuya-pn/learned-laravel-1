<?php

namespace App\Services;

use InterventionImage;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public static function upload($imageFile, $folderName)
    {
        if(is_array($imageFile)){
            $file = $imageFile['image'];
        }else{
            $file = $imageFile;
        }
        $resizedImage = InterventionImage::make($file)
                    ->resize(1920, null, function($constraint){
                        $constraint->aspectRatio();
                    })->encode();
        $fileName = uniqid(rand() . '_');
        $extension = $file->extension();
        $fileNameToStore = $fileName . '.' . $extension;
        Storage::put('public/' . $folderName . '/' . $fileNameToStore, $resizedImage);

        return $fileNameToStore;
    }
    
}