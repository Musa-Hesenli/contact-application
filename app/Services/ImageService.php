<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageService
{
    public static function uploadImage( $file, $uploadPath, $width = 500, $height = 500, $quality = 90 )
    {
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $image    = Image::make( $file );

        $image->fit( $width, $height );
        $image->encode( null, $quality );

        Storage::disk( 'public' )->put( $uploadPath . '/' . $filename, $image->__toString() );

        return $uploadPath . '/' . $filename;
    }
}
