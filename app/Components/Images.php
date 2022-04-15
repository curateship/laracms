<?php

namespace App\Components;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Arr;
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

    public static function cleanStorage(){
        $images_filenames = [];

        /* Posts */
        $posts = Post::all();
        foreach($posts as $post){
            // Images from post;
            $in_storage_name = $post->original;
            $temp = explode('.', $in_storage_name);
            $file_name = Arr::last(explode('/', $temp[0]));
            $images_filenames[] = $file_name;

            // Images from post body;
            $body_array = json_decode($post->body, true);
            if(isset($body_array['blocks'])){
                foreach($body_array['blocks'] as $block){
                    if($block['type'] == 'image'){
                        $url_array = Arr::last(explode('/', $block['data']['file']['url']));
                        $file_name = Arr::first(explode('.', $url_array));
                        $images_filenames[] = $file_name;
                    }
                }
            }
        }

        /* Tags */
        $tags = Tag::all();
        foreach($tags as $tag){
            // Images from post;
            $in_storage_name = $tag->original;
            $temp = explode('.', $in_storage_name);
            $file_name = Arr::last(explode('/', $temp[0]));
            $images_filenames[] = $file_name;

            // Images from post body;
            $body_array = json_decode($tag->body, true);
            if(isset($body_array['blocks'])){
                foreach($body_array['blocks'] as $block){
                    if($block['type'] == 'image'){
                        $url_array = Arr::last(explode('/', $block['data']['file']['url']));
                        $file_name = Arr::first(explode('.', $url_array));
                        $images_filenames[] = $file_name;
                    }
                }
            }
        }

        foreach($images_filenames as $key => $item){
            if($item == ''){
                unset($images_filenames[$key]);
            }
        }

        // Check every folder in storage;
        $check_array = ['posts', 'tags', 'videos'];
        $sub_array = ['original', 'medium', 'thumbnail'];

        foreach($check_array as $check_item){
            foreach($sub_array as $sub_item){
                $path = storage_path().'/app/public/'.$check_item.'/'.$sub_item;
                $files = scandir($path);
                foreach($files as $file){
                    // Skipping crumbs;
                    if(in_array($file, ['.', '..'])){
                        continue;
                    }

                    $file_name = Arr::first(explode('.', $file));
                    // If file does not exist in images array - remove it;
                    if(!in_array($file_name, $images_filenames)){
                        unlink($path.'/'.$file);
                    }
                }
            }
        }
    }
}
