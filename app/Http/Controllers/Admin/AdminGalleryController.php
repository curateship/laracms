<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
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
            $galleries = Gallery::orderBy($request->input('sortBy'), $request->input('sortDesc'));
        }   else{
            $galleries = Gallery::orderBy('created_at', 'DESC')->whereNotNull('user_id');
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
                    ->whereOr('description', 'like', '%'.$search_input.'%');
            });
        }

        return view('admin.galleries.index', [
            'galleries' => $galleries->paginate(10),
            'status' => $status
        ]);
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request){
        if($request->has('status') && $request->input('status') == 'delete'){
            $gallery = Gallery::find($request->input('galleryId'));

            if(Auth::id() == $gallery->user_id || Gate::allows('is-admin')){
                $gallery->dropWithContent();

                return redirect('/galleries');
            }

            return abort(404);
        }

        $title = strip_tags($request->input('title'));

        // Generate slug
        $slug = Str::slug($title, '-');
        $gallery_with_same_slug = Gallery::where('slug', 'like', $slug . '%');

        if($request->has('galleryId')){
            $gallery_with_same_slug = $gallery_with_same_slug->where('id', '!=', $request->has('galleryId'));
        }

        $gallery_with_same_slug = $gallery_with_same_slug->get();

        if (count($gallery_with_same_slug) > 0) {
            $slug = Post::getNewSlug($slug, $gallery_with_same_slug);
        }

        $original = ( $request->has('original') && !empty($request->input('original')) ) ? $request->input('original') : NULL;
        $original = str_replace(url('/storage'.config('images.galleries_storage_path')), '', $original);

        $thumbnail = ( $request->has('thumbnail') && !empty($request->input('thumbnail')) ) ? $request->input('thumbnail') : NULL;
        $thumbnail = str_replace(url('/storage'.config('images.galleries_storage_path')), '', $thumbnail);

        $medium = ( $request->has('medium') && !empty($request->input('medium')) )  ? $request->input('medium') : NULL;
        $medium = str_replace(url('/storage'.config('images.galleries_storage_path')), '', $medium);

        if($request->has('galleryId')){
            $gallery = Gallery::find($request->input('galleryId'));

            // If user was attached new image - we must remove old file;
            if($gallery->original != $original){
                $path = '/public'.config('images.galleries_storage_path');

                Storage::delete($path.$gallery->original['original']);
                Storage::delete($path.$gallery->medium);
                Storage::delete($path.$gallery->thumbnail);
            }

            // If body was update;
            if($gallery->description != $request->input('description')){
                $path = '/public'.config('images.posts_storage_path');

                // Get current body images;
                $current_images = [];

                $body_array = json_decode($gallery->description, true);
                foreach($body_array['blocks'] as $block){
                    if($block['type'] == 'image'){
                        $url_array = explode('/', $block['data']['file']['url']);
                        $current_images[] = Arr::last($url_array);
                    }
                }

                // New body images;
                $new_images = [];
                $body_array = json_decode($request->input('description'), true);
                foreach($body_array['blocks'] as $block){
                    if($block['type'] == 'image'){
                        $url_array = explode('/', $block['data']['file']['url']);
                        $new_images[] = Arr::last($url_array);
                    }
                }

                // If we do not have old image in new list - delete this file;
                foreach($current_images as $image){
                    if(!in_array($image, $new_images)){
                        Storage::delete($path.'/original/'.$image);
                        Storage::delete($path.'/medium/'.$image);
                        Storage::delete($path.'/thumbnail/'.$image);
                    }
                }
            }
        }   else{
            $gallery = new Gallery();
            $gallery->user_id = Auth::id();
        }

        $description = $request->input('description');
        $description = $description ?? json_encode([]);

        $gallery->title = $title;
        $gallery->slug = $slug;
        $gallery->description = $description;
        $gallery->original = $original;
        $gallery->thumbnail = $thumbnail;
        $gallery->medium = $medium;

        if($request->has('status') && in_array($request->input('status'), ['draft', 'published'])){
            $gallery->status = $request->input('status');
        }

        $gallery->save();

        $gallery->parsePosts($request->input('uploaded-images'));

        if($request->has('galleryId') || $request->input('status') == 'draft'){
            return redirect('/gallery/edit/'.$gallery->slug);
        }   else{
            return redirect('/gallery/'.$gallery->slug);
        }
    }

    public function multiUpload(Request $request){
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

        $path = '/public'.config('images.posts_storage_path');
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
            'fileName' => $thumbnail_medium_name
        ]);
    }

    public function upload(Request $request){
        $path = '/public'.config('images.galleries_storage_path');

        $original = request()->file('image')->getClientOriginalName();
        $thumbnail_medium_name = Str::random(27) . '.' . Arr::last(explode('.', $original));

        $mime_type = $request->file('image')->getMimeType();
        $media_type = substr($mime_type, 0, 5) === 'image' ? 'image' : 'video';

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

        // Save original media file in file system;
        $original = request()->file('image')->storeAs($path."/original", $thumbnail_medium_name);

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
                    $source = request()->file('image');
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

        return $media;
    }

    public function destroy(string $ids, Request $request)
    {

        $ids = explode(',', $ids);

        foreach($ids as $id){
            $gallery = Gallery::find($id);
            $gallery->dropWithContent();
        }

        if(count($ids) > 1){
            $request->session()->flash('success', 'You have deleted all selected galleries');
        }   else{
            $request->session()->flash('success', 'You have deleted the gallery');
        }
    }

    public function edit($gallery_slug){
        $gallery = Gallery::where('slug', $gallery_slug)
            ->first();

        // Only author or author can preview posts in draft;
        if(!Gate::allows('is-admin') && (!Auth::guest() && Auth::id() != $gallery->user_id)){
            return abort(404);
        }

        if($gallery == null){
            return abort(404);
        }

        $posts = DB::table('galleries_posts')
            ->where('gallery_id', $gallery->id)
            ->get();

        $posts_urls = [];
        $posts_files = [];
        foreach($posts as $post){
            $post = Post::find($post->post_id);

            $posts_files[] = str_replace('/thumbnail/', '', $post->thumbnail);
            $posts_urls[] = url('/storage'.config('images.posts_storage_path').$post->thumbnail);
        }

        return view('admin.galleries.edit', [
            'gallery' => $gallery,
            'posts_urls' => $posts_urls,
            'posts_files' => $posts_files
        ]);
    }
}
