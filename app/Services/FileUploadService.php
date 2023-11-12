<?php

namespace App\Services;

use Illuminate\Http\Request;

class FileUploadService
{
    public function upload(Request $request, $fileInputName, $uploadPath, $diskName)
    {
        if ($request->file($fileInputName) && $request->file($fileInputName)->isValid()) {
            $file = $request->file($fileInputName);
            $fileName = $file->hashName();
            $file->storeAs($uploadPath, $fileName, $diskName);

            return $fileName;
        }

        return null;
    }
}
