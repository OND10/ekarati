<?php

namespace  Modules\CommonService\Shared\Handler;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageUploads
{
    /**
     * Upload an image to a specific directory and return the URL.
     * Appends 8 random characters to the original file name and prepends
     * the base URL to match the public folder structure.
     *
     * @param UploadedFile $image
     * @param string $directory
     * @return string|null
     */
    public static function uploadImage(UploadedFile $image, string $directory = 'students'): ?string
    {
        if ($image) {
            // Get original filename and extension
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();

            // Generate a random 8-character string
            $randomString = substr(md5(uniqid(rand(), true)), 0, 8);

            // Create new filename
            $newFileName = $originalName . '_' . $randomString . '.' . $extension;

            // Store the file under the provided directory on the 'public' disk.
            // This will place the file in: public/uploads/{directory}/{newFileName}
            $path = $image->storeAs($directory, $newFileName, 'public');

            // Return the full URL. Adjust the prefix if needed (here we assume files are in "uploads")
            return asset('uploads/' . $path);
        }
        return null;
    }
}
