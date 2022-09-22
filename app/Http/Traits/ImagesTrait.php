<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\File;

trait ImagesTraits
{

    public function uploadFile($file, $path, $fileName,  $oldFile = null)
    {
        $file->storeAs($path, $fileName, 'public');

        if ($oldFile) {

            File::delete($oldFile);
        }
    }

    public function deleteFile($path)
    {
        if (File::exists($path)) {
            File::deleteDirectory($path);
        }
    }
}
