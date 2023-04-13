<?php

namespace App\Services;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
// use Image;

class SaveImageService
{
    public static function UploadImage($requestImage, $model, $folder)
    {
        // option 1
        $path = Storage::putFile('public/' . $folder, new File($requestImage));
        $target_path = storage_path('app/', $path);
        // Image::make($requestImage)->resize(1200, 630)->save($target_path);
        $model->image = $path;
        $model->save();

        // option 2
        // $image = $requestImage;
        // $imageName = $image->getClientOriginalName();
        // $imageNewName = explode('.', $imageName)[0];
        // $fileExtenstion = time(). '.' . $imageNewName . '.' . $image->getClientOriginalExtenstion();
        // $location = storage_path('app/public/') . $folder . '/' . $fileExtenstion ;
        // $path = $image->storeAs('photos', $fileExtenstion);
        // Image::make($image)->resize(1200, 630)->save($location);
        // $model->image = $fileExtenstion;

        // $file = $request->file('photo');
        // // generate a new filename. getClientOriginalExtension() for the file extension
        // $filename = 'profile-photo-' . time() . '.' . $file->getClientOriginalExtension();

        // // save to storage/app/photos as the new $filename
        // $path = $file->storeAs('photos', $filename);
    }
}
