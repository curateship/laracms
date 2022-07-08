<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;
use Imagick;
use Thumbnail;

class AdminGalleryController extends Controller
{
    //
    public function index(Request $request)
    {

        SEOMeta::setTitle(config('seotools.static_titles.'.get_called_class().'.'.__FUNCTION__));
        if($request->has('sortBy') && $request->input('sortBy') !== 'role'){
            $galleries = Post::orderBy($request->input('sortBy'), $request->input('sortDesc'));
        }   else{
            $galleries = Post::orderBy('created_at', 'DESC')->whereNotNull('user_id');
        }

        $status = 'All';
        if($request->has('status') && $request->input('status') != 'All'){
            $galleries = $galleries->where('status', strtolower($request->input('status')));
            $status = ucfirst($request->input('status'));
        }

        if($request->has('search') && $request->input('search') != ''){
            $search_input = $request->input('search');
            $galleries = $galleries->where(function($query) use ($search_input){
                $query->where('title', 'like', '%'.$search_input.'%')
                    ->whereOr('body', 'like', '%'.$search_input.'%');
            });
        }

        $galleries = $galleries->where('type', 'gallery');
        $galleries = $galleries->paginate(10);
        foreach($galleries as $gallery){
            $images = Storage::allFiles('/public/'.config('images.galleries_storage_path').'/'.$gallery->slug.'/medium/');

            if(count($images) == 0){
                continue;
            }
            $image = str_replace('public/galleries/', '/', $images[0]);
            $gallery->medium = $image;
        }

        return view('admin.posts.index', [
            'posts' => $galleries,
            'status' => $status
        ]);
    }

    public function upload(Request $request){
        header('Content-type:application/json;charset=utf-8');

        if (
            !isset($_FILES['file']['error']) ||
            is_array($_FILES['file']['error'])
        ) {
            throw new RuntimeException('Invalid parameters.');
        }

        switch ($_FILES['file']['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new RuntimeException('No file sent.');
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                throw new RuntimeException('Exceeded filesize limit.');
            default:
                throw new RuntimeException('Unknown errors.');
        }

        $path = '/public'.config('images.galleries_storage_path').'/_temp';
        $original = request()->file('file')->getClientOriginalName();
        $thumbnail_medium_name = Str::random(27) . '.' . Arr::last(explode('.', $original));

        $mime_type = $request->file('file')->getMimeType();
        $media_type = 'image';

        $media_path = storage_path() . "/app";
        $media = [
            'original', 'medium', 'thumbnail'
        ];

        foreach($media as $key => $type){
            File::ensureDirectoryExists($media_path . $path.'/'.$type);
            $media[$type] = config("images.$type");
            unset($media[$key]);
        }
        unset($media['original']);

        $original = request()->file('file')->storeAs($path."/original", $thumbnail_medium_name);
        foreach($media as $type_name => $type){
            /* Gif and Images */
            if ($mime_type == 'image/gif') {
                /* GIF */
                $thumbnail_medium = new Imagick($media_path.'/'.$original);
                $thumbnail_medium = $thumbnail_medium->coalesceImages();
                do {
                    $thumbnail_medium->resizeImage( $type['width'], $type['height'], Imagick::FILTER_BOX, 1, true );
                } while ( $thumbnail_medium->nextImage());

                $thumbnail_medium = $thumbnail_medium->deconstructImages();

                $thumbnail_medium->writeImages($media_path . "$path/$type_name/" . $thumbnail_medium_name, true);
            }   else{
                /* Other Image types */
                if($request->has('url')){
                    $source = Storage::get($path."/original".$thumbnail_medium_name);
                }   else{
                    $source = request()->file('file');
                }

                $thumbnail_medium = \Intervention\Image\Facades\Image::make($source);
                $thumbnail_medium->resize($type['width'], $type['height'], function($constraint){
                    $constraint->aspectRatio();
                });


                $thumbnail_medium->save($media_path . "$path/$type_name/" . $thumbnail_medium_name);
            }

            $media[$type_name]['path'] = $media_path . "$path/$type_name/" . $thumbnail_medium_name;
        }

        // Clean response array;
        foreach($media as $key => $item){
            $media[$key]['path'] = url('/').Storage::url(str_replace($media_path.'/', '', $item['path']));
            unset($media[$key]['width']);
            unset($media[$key]['height']);
        }

        $media['original']['path'] = url('/').Storage::url($original);
        $media['content'] = '<img alt="thumbnail" src="'.$media['thumbnail']['path'].'">';
        $media['type'] = $media_type;

        // All good, send the response
        echo json_encode([
            'status' => 'ok',
            'path' => $media['thumbnail']['path'],
            'media' => $media
        ]);
    }
}
