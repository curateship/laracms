<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;
use FFMpeg\Format\Video\Ogg;
use FFMpeg\Format\Video\WebM;
use FFMpeg\Format\Video\WMV;
use FFMpeg\Format\Video\WMV3;
use FFMpeg\Format\Video\X264;
use FFMpeg\Coordinate;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminVideoController extends Controller
{
    //
    public function upload($upload_type, Request $request){
        $path = '/public'.config('images.posts_storage_path');
        $path_video = '/public'.config('images.videos_storage_path');
        $media_type = 'video';

        if($request->has('url')){
            ini_set('memory_limit', '-1');

            $url = $request->input('url');
            $thumbnail_medium_name = Str::random(27) . '.' . Arr::last(explode('.', $url));

            try {
                Storage::put($path_video."/original/".$thumbnail_medium_name, file_get_contents($url));
            }catch(Exception $e){
                return [
                    'success' => 0,
                    'message' => 'Failed to upload file from external URL'
                ];
            }


        }   else{
            $original = request()->file('image')->getClientOriginalName();
            $thumbnail_medium_name = Str::random(27) . '.' . Arr::last(explode('.', $original));

            request()->file('image')->storeAs($path_video."/original", $thumbnail_medium_name);
        }

        $media_path = storage_path() . "/app";
        $media = [
            'original', 'medium', 'thumbnail'
        ];

        foreach($media as $key => $type){
            File::ensureDirectoryExists($media_path . $path.'/'.$type);
            File::ensureDirectoryExists($media_path . $path_video.'/'.$type);
            $media[$type] = config("images.$type");
            unset($media[$key]);
        }
        unset($media['original']);


        /* Video files */
        $ffprobe = FFProbe::create();
        $video_stream = $ffprobe
            ->streams(storage_path() . "/app".$path_video."/original/" . $thumbnail_medium_name)
            ->videos()
            ->first();

        /* At first, we need to compress video */
        // Get current video size;
        $video_dimensions = $video_stream->getDimensions();
        $width = $video_dimensions->getWidth();
        $height = $video_dimensions->getHeight();

        // Compress video;
        $compress_array = [
            [
                'path' => 'original',
                'resolution' => 0
            ],
            [
                'path' => 'thumbnail',
                'resolution' => 480
            ],
            [
                'path' => 'medium',
                'resolution' => 720
            ],
        ];

        $video_extension = strtolower(substr($thumbnail_medium_name, strrpos($thumbnail_medium_name,".") + 1));
        $image_file_name = str_replace('.'.$video_extension, '', $thumbnail_medium_name).'.jpg';

        foreach($compress_array as $compress){
            if($height < $width){
                // For Landscape view;
                $m_video_width = $compress['path'] == 'original' ? $width : $compress['resolution'];
                $m_video_height = ceil($height * ($compress['path'] == 'original' ? $width : $compress['resolution']/$width));
                if($m_video_height % 2 == 1) $m_video_height++;
            }   else{
                // For Portrait view;
                $m_video_height = $compress['path'] == 'original' ? $height : $compress['resolution'];
                $m_video_width = ceil($width * ($compress['path'] == 'original' ? $height : $compress['resolution']/$height));
                if($m_video_width % 2 == 1) $m_video_width++;
            }

            // Resize video
            $ffmpeg = FFMpeg::create();
            $m_video = $ffmpeg->open(storage_path() . "/app".$path_video."/original/" . $thumbnail_medium_name);
            $m_video
                ->filters()
                ->resize(new Dimension($m_video_width, $m_video_height))
                ->synchronize();

            switch($video_extension){
                case 'ogg':
                    $format = new Ogg();
                    break;
                case 'webm':
                    $format = new WebM();
                    break;
                case 'wmv':
                    $format = new WMV();
                    break;
                case 'wmv3':
                    $format = new WMV3();
                    break;
                default:
                    $format = new X264();

            }

            $format
                ->setKiloBitrate(704)
                ->setAudioChannels(2)
                ->setAudioKiloBitrate(256);

            if($compress['path'] != 'original'){
                $m_video->save($format, storage_path() . "/app".$path_video."/".$compress['path']."/" . $thumbnail_medium_name);
            }

            /* Make preview images for post */
            $source = storage_path() . "/app".$path."/".$compress['path']."/" . $image_file_name;
            $m_video
                ->frame(Coordinate\TimeCode::fromSeconds(5))
                ->save($source);

            // Resize preview;
            $thumbnail_medium = \Intervention\Image\Facades\Image::make($source);
            $thumbnail_medium->resize($m_video_width, $m_video_height, function($constraint){
                $constraint->aspectRatio();
            });

            $thumbnail_medium->save($source);
        }

        // Add images paths in response;
        $path_array = ['original', 'medium', 'thumbnail'];
        foreach($path_array as $path_item){
            $media[$path_item]['path'] =  $media_path . "$path/$path_item/" . $image_file_name;
            $media['video_'.$path_item]['path'] =  $media_path . "$path_video/$path_item/" . $thumbnail_medium_name;
        }

        // Clean response array;
        foreach($media as $key => $item){
            $media[$key]['path'] = url('/').Storage::url(str_replace($media_path.'/', '', $item['path']));
            unset($media[$key]['width']);
            unset($media[$key]['height']);
        }

        // Render video player;
        $media['content'] = view('admin.posts.script-video-js-player', [
            'poster' => $media['medium']['path'],
            'video_mp4' => $media['video_medium']['path'],
            'video_webm' => $media['video_medium']['path'],
            'player_width' => config('images.player_size_thumbnail.width'),
            'player_height' => config('images.player_size_thumbnail.height')
        ])->render();

        $media['type'] = $media_type;

        if($upload_type == 'main'){
            return $media;
        }

        if($upload_type == 'editor'){
            return [
                'success' => 1,
                'file' => [
                    'url' => $media['medium']['path']
                ]
            ];
        }

        return null;
    }
}
