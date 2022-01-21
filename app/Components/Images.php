<?php

namespace App\Components;

trait Images
{
    public static function randomBackground(){
        // Getting all images from target folder;
        $files = \Illuminate\Support\Facades\Storage::files('public/random-backgrounds');
        // Get random image from file list;
        $rand_image = $files[rand(0, count($files)-1)];
        // Replace some useless chars and return result;
        return str_replace('public', '/storage', $rand_image);
    }
}
