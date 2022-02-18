<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;
use FFMpeg\Format\Video\Ogg;
use FFMpeg\Format\Video\WebM;
use FFMpeg\Format\Video\WMV;
use FFMpeg\Format\Video\WMV3;
use FFMpeg\Format\Video\X264;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Lakshmaji\Thumbnail\Thumbnail;

class PostController extends Controller
{
    public function store(Request $request){

        $title = strip_tags($request->input('title'));

        // Generate slug
        $slug = Str::slug($title, '-');

        dump($slug);
        dd($request->all());
    }

    public function show(Post $post) {

        $recent_posts = Post::latest()->take(5)->get();

        return view('/theme.default.posts.single', [
            'post' => $post,
            'recent_posts' => $recent_posts,
        ]);
    }

    public function addComment(Post $post)
    {
        $attributes = request()->validate([
            'the_comment' => 'required|min:10|max:1000'
        ]);

        $attributes['user_id'] = auth()->id();
        $comment = $post->comments()->create($attributes);

        return redirect('/post/' . $post->slug . '#comment_' . $comment->id)->with('success', 'Comment has been added.');
    }

    public function upload(Request $request){
        $mime_type = $request->file('file')->getMimeType();
        $media_path = storage_path() . "/app";
        $media = [
            'original', 'medium', 'thumbnail'
        ];

        foreach($media as $key => $type){
            File::ensureDirectoryExists($media_path . '/public/posts/'.$type);
            $media[$type] = config("images.$type");
            unset($media[$key]);
        }
        unset($media['original']);

        // Save original media file in file system;
        $original = request()->file('file')->store("public/posts/original");

        $thumbnail_medium_name = Str::random(27) . '.' . Arr::last(explode('.', $original));

        foreach($media as $type_name => $type){
            if ($mime_type == 'image/gif') {
                /* GIF */
                $thumbnail_medium = new Imagick($media_path.'/'.$original);
                $thumbnail_medium = $thumbnail_medium->coalesceImages();
                do {
                    $thumbnail_medium->resizeImage( $type['width'], $type['height'], Imagick::FILTER_BOX, 1, true );
                } while ( $thumbnail_medium->nextImage());

                $thumbnail_medium = $thumbnail_medium->deconstructImages();

                $thumbnail_medium->writeImages($media_path . "/public/posts/$type_name/" . $thumbnail_medium_name, true);
            }   else{
                /* Other Image types */
                $thumbnail_medium = Image::make(request()->file('file'));
                $thumbnail_medium->resize($type['width'], $type['height'], function($constraint){
                    $constraint->aspectRatio();
                });


                $thumbnail_medium->save($media_path . "/public/posts/$type_name/" . $thumbnail_medium_name);
            }

            $media[$type_name]['path'] = $media_path . "/public/posts/$type_name/" . $thumbnail_medium_name;
        }

        foreach($media as $key => $item){
            $media[$key]['path'] = url('/').Storage::url(str_replace($media_path.'/', '', $item['path']));
            unset($media[$key]['width']);
            unset($media[$key]['height']);
        }

        $media['original']['path'] = url('/').Storage::url($original);

        return $media;
    }
}
