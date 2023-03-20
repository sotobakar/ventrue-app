<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageService
{

  public function __construct()
  {
  }

  /**
   * Store image to folder with aspect ratio.
   * 
   * @return string Path to file.
   */
  public function storeAndReplace($image, int $width, int $height, string $storage_path, string $old_image = null)
  {
    /** @var \Illuminate\Http\UploadedFile */
    $file = $image;

    // Resize Image
    $resized_image = Image::make($file->getPathName())
      ->orientate()
      ->fit($width, $height, function ($constraint) {
        $constraint->aspectRatio();
      })->encode();

    // Rename file
    $now = \Carbon\Carbon::now()->toDateTimeString();
    $file_name = md5($resized_image->__toString() . $now);
    $path =  $storage_path . "/{$file_name}.{$file->getClientOriginalExtension()}";

    // Save to storage/public/organizations/images folder
    $resized_image->save(Storage::disk('public')->path($path));

    // Delete previous image
    if (!is_null($old_image)) {
      if (Storage::disk('public')->exists($old_image)) {
        Storage::disk('public')->delete($old_image);
      }
    }

    // Set validated input to path
    return $path;
  }
}
