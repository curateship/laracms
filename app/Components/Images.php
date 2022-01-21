<?php

namespace App\Components;

use Illuminate\Support\Facades\File;

trait Images
{
    public static function randomBackground(){
        $folder = '/assets/img/random-backgrounds/';
        // Getting all images from target folder;
        $files = File::files(public_path().$folder);
        // Get random image from file list;
        $rand_image = $files[rand(0, count($files)-1)]->getFilename();
        // Replace some useless chars and return result;
        return $folder.$rand_image;
    }
}
