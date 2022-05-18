<?php

namespace App\Http\Controllers\Admin;

// Others
use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Notification;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;
use FFMpeg\Coordinate;
use FFMpeg\Format\Video\Ogg;
use FFMpeg\Format\Video\WebM;
use FFMpeg\Format\Video\WMV;
use FFMpeg\Format\Video\WMV3;
use FFMpeg\Format\Video\X264;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;

// Models
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Role;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\TagsCategories;

// Support
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Imagick;
use Thumbnail;

class AdminPostController extends Controller
{
    // Index
    public function index(Request $request)
    {

        SEOMeta::setTitle(config('seotools.static_titles.'.get_called_class().'.'.__FUNCTION__));
        if($request->has('sortBy') && $request->input('sortBy') !== 'role'){
            $posts = Post::orderBy($request->input('sortBy'), $request->input('sortDesc'));
        }   else{
            $posts = Post::orderBy('created_at', 'DESC')->whereNotNull('user_id');
        }

        $status = 'All';
        if($request->has('status') && $request->input('status') != 'All'){
            $posts = $posts->where('status', strtolower($request->input('status')));
            $status = ucfirst($request->input('status'));
        }

        if($request->has('search') && $request->input('search') != ''){
            $search_input = $request->input('search');
            $posts = $posts->where(function($query) use ($search_input){
                $query->where('title', 'like', '%'.$search_input.'%')
                    ->whereOr('body', 'like', '%'.$search_input.'%');
            });
        }

        return view('admin.posts.index', [
            'posts' => $posts->paginate(10),
            'status' => $status
        ]);
    }

    // Create
    public function create()
    {
        return view('admin.posts.create', [
            'categories' => Category::pluck('name', 'id')
        ]);
    }

    // Edit
    public function edit($post_slug)
    {
        $post = Post::where('slug', $post_slug)
            ->first();

        // Only author or author can preview posts in draft;
        if(!Gate::allows('is-admin') && (!Auth::guest() && Auth::id() != $post->user_id)){
            return abort(404);
        }

        if($post->type == 'video'){
            $video = DB::table('posts_videos')
                ->where('post_id', $post->id)
                ->first();

            $post->video_original = $video->original;
            $post->video_medium = $video->medium;
            $post->video_thumbnail = $video->thumbnail;
        }

        if($post == null){
            return abort(404);
        }

        if($post->type == 'image'){
            $content = '<img alt="thumbnail" src="'.'/storage'.config('images.posts_storage_path').$post->thumbnail.'">';
        }   else{
            // Render video player;
            $content = view('admin.posts.script-video-js-player', [
                'poster' => '/storage'.config('images.posts_storage_path').$post->thumbnail,
                'video_mp4' => '/storage'.config('images.videos_storage_path').$post->video_thumbnail,
                'video_webm' => '/storage'.config('images.videos_storage_path').$post->video_thumbnail,
                'player_width' => config('images.player_size_thumbnail.width'),
                'player_height' => config('images.player_size_thumbnail.height')
            ])->render();
        }

        return view('admin.posts.edit', [
            'post' => $post,
            'content' => $content,
            'categories' => Category::pluck('name', 'id')
        ]);
    }

    // Destroy
    public function destroy(string $ids, Request $request)
    {
        $ids = explode(',', $ids);

        foreach($ids as $id){
            // Remove tags links;
            DB::table('post_tag')
                ->where('post_id', $id)
                ->delete();

            // Remove all reply comments;
            Comment::where('post_id', $id)
                ->whereNotNull('reply_id')
                ->delete();

            // Remove all comment;
            Comment::where('post_id', $id)
                ->whereNull('reply_id')
                ->delete();

            // Remove all video links;
            DB::table('posts_videos')
                ->where('post_id', $id)
                ->delete();

            // Remove all views;
            DB::table('posts_views')
                ->where('post_id', $id)
                ->delete();

            // Remove likes;
            Like::where('post_id', $id)
                ->delete();

            // Remove post images;
            $post = Post::find($id);
            $post->removePostImages('main');
            $post->removePostImages('body');

            // And then - remove the post;
            Post::destroy($id);
        }

        if(count($ids) > 1){
            $request->session()->flash('success', 'You have deleted all selected posts');
        }   else{
            $request->session()->flash('success', 'You have deleted the post');
        }
    }

    // Upload Images
    public function upload($upload_type, Request $request){
        $path = '/public'.config('images.posts_storage_path');
        $path_video = '/public'.config('images.videos_storage_path');

        if($request->has('url')){
            $url = $request->input('url');
            $file_ext = Arr::last(explode('.', $url));
            $thumbnail_medium_name = Str::random(27) . '.' . $file_ext;

            Storage::put($path."/original".$thumbnail_medium_name, file_get_contents($url));
            $media_type = 'image';
            $mime_type = Storage::mimeType($path."/original".$thumbnail_medium_name);
        }   else{
            $original = request()->file('image')->getClientOriginalName();
            $thumbnail_medium_name = Str::random(27) . '.' . Arr::last(explode('.', $original));

            $mime_type = $request->file('image')->getMimeType();
            $media_type = substr($mime_type, 0, 5) === 'image' ? 'image' : 'video';
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

        // Save original media file in file system;
        if($media_type == 'image'){
            if($request->has('url')){
                $original = $path."/original".$thumbnail_medium_name;
            }   else{
                $original = request()->file('image')->storeAs($path."/original", $thumbnail_medium_name);
            }

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
        }

        /* Video files */
        if($media_type == 'video'){
            $original = request()->file('image')->storeAs($path_video."/original", $thumbnail_medium_name);

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
        }

        // Clean response array;
        foreach($media as $key => $item){
            $media[$key]['path'] = url('/').Storage::url(str_replace($media_path.'/', '', $item['path']));
            unset($media[$key]['width']);
            unset($media[$key]['height']);
        }

        if($media_type == 'image'){
            $media['original']['path'] = url('/').Storage::url($original);
            $media['content'] = '<img alt="thumbnail" src="'.$media['thumbnail']['path'].'">';
        }   else{
            // Render video player;
            $media['content'] = view('admin.posts.script-video-js-player', [
                'poster' => $media['medium']['path'],
                'video_mp4' => $media['video_medium']['path'],
                'video_webm' => $media['video_medium']['path'],
                'player_width' => config('images.player_size_thumbnail.width'),
                'player_height' => config('images.player_size_thumbnail.height')
            ])->render();
        }

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

    // Store or update;
    public function store(Request $request){
        $title = strip_tags($request->input('title'));

        // Generate slug
        $slug = Str::slug($title, '-');
        $posts_with_same_slug = Post::where('slug', 'like', $slug . '%');

        if($request->has('postId')){
            $posts_with_same_slug = $posts_with_same_slug->where('id', '!=', $request->has('postId'));
        }

        $posts_with_same_slug = $posts_with_same_slug->get();

        if (count($posts_with_same_slug) > 0) {
            $slug = Post::getNewSlug($slug, $posts_with_same_slug);
        }

        $category = Category::where('name', $request->input('category'))
            ->first();

        $original = ( $request->has('original') && !empty($request->input('original')) ) ? $request->input('original') : NULL;
        $original = str_replace(url('/storage'.config('images.posts_storage_path')), '', $original);

        $thumbnail = ( $request->has('thumbnail') && !empty($request->input('thumbnail')) ) ? $request->input('thumbnail') : NULL;
        $thumbnail = str_replace(url('/storage'.config('images.posts_storage_path')), '', $thumbnail);

        $medium = ( $request->has('medium') && !empty($request->input('medium')) )  ? $request->input('medium') : NULL;
        $medium = str_replace(url('/storage'.config('images.posts_storage_path')), '', $medium);

        if($request->input('type') == 'video'){
            $video_original = ( $request->has('video_original') && !empty($request->input('video_original')) ) ? $request->input('video_original') : NULL;
            $video_original = str_replace(url('/storage'.config('images.videos_storage_path')), '', $video_original);

            $video_thumbnail = ( $request->has('video_thumbnail') && !empty($request->input('video_thumbnail')) ) ? $request->input('video_thumbnail') : NULL;
            $video_thumbnail = str_replace(url('/storage'.config('images.videos_storage_path')), '', $video_thumbnail);

            $video_medium = ( $request->has('video_medium') && !empty($request->input('video_medium')) )  ? $request->input('video_medium') : NULL;
            $video_medium = str_replace(url('/storage'.config('images.videos_storage_path')), '', $video_medium);
        }

        if($request->has('postId')){
            $post = Post::find($request->input('postId'));

            // If user was attached new image - we must remove old file;
            if($post->original != $original){
                $post->removePostImages('main');
            }

            // If body was update;
            if($post->body != $request->input('description')){
                $path = '/public'.config('images.posts_storage_path');

                // Get current body images;
                $current_images = [];

                $body_array = json_decode($post->body, true);
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
            $post = new Post();
            $post->user_id = Auth::id();
        }

        $old_title = $post->title;
        $old_body = $post->id == null ? json_encode(['blocks' => []]) : $post->body;

        $post->title = $title;
        $post->excerpt = '';
        $post->slug = $slug;
        $post->body = $request->input('description');
        $post->category_id = $category->id;
        $post->original = $original;
        $post->thumbnail = $thumbnail;
        $post->medium = $medium;
        $post->type = $request->input('type');

        if($request->has('status') && in_array($request->input('status'), ['draft', 'published'])){
            $post->status = $request->input('status');
        }

        $post->save();

        // Now we can save excerpt;
        $post->excerpt = strip_tags($post->body('short', 200));
        $post->save();

        // If we have "video" type for this post - save video info;
        if($request->input('type') == 'video'){
            // Add DB link for this post;
            DB::table('posts_videos')
                ->insert([
                    'post_id' => $post->id,
                    'original' => $video_original,
                    'medium' => $video_medium,
                    'thumbnail' => $video_thumbnail,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
        }

        // Tags;
        // Removing old tags links;
        DB::table('post_tag')
            ->where('post_id', $post->id)
            ->delete();

        foreach (TagsCategories::all() as $tag_category) {
            if (request()->has('tag_category_' . $tag_category->id)) {

                $tags_input = request('tag_category_' . $tag_category->id);

                foreach ($tags_input as $tag_input) {
                    if(is_numeric($tag_input)){
                        $tag = Tag::where('id', $tag_input)
                            ->where('category_id', $tag_category->id)
                            ->first();
                    }   else{
                        $tag = Tag::where('name', $tag_input)
                            ->where('category_id', $tag_category->id)
                            ->first();
                    }

                    // If tag doesn't exist yet, create it;
                    if ($tag == null) {
                        $tag = new Tag;
                        $tag->body = '{"time": '.time().',"blocks":[]}';
                        $tag->name = $tag_input;
                        $tag->category_id = $tag_category->id;

                        $slug = Str::slug($tag_input, '-');
                        $exist = Tag::where('slug', 'like', $slug . '%')
                            ->get();

                        if (count($exist) > 0) {
                            $slug = Post::getNewSlug($slug, $exist);
                        }

                        $tag->slug = $slug;
                        $tag->save();
                    }

                    // Insert post_tag;
                    DB::table('post_tag')
                        ->insert([
                            'post_id' => $post->id,
                            'tag_id' => $tag->id,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                        ]);
                }
            }
        }

        // Add notifications;
        if($request->input('status') != 'draft'){
            if(json_decode($old_body)->blocks != json_decode($post->body)->blocks || $old_title != $post->title){
                $user = User::find($post->user_id);

                if($request->has('postId')){
                    // Remove old notifications;
                    Notification::removeNotificationForPost($post->id);

                    $user->followersBroadcast(Auth::user()->name, 'Updated a post: '.$post->title, '/post/'.$post->slug, $post->id);
                }   else{
                    $user->followersBroadcast(Auth::user()->name, 'Added a new post: '.$post->title, '/post/'.$post->slug, $post->id);
                }
            }
        }   else{
            // If post moved to draft status - remove old notifications;
            Notification::removeNotificationForPost($post->id);
        }

        if($request->has('postId') || $request->input('status') == 'draft'){
            return redirect('/post/edit/'.$post->slug);
        }   else{
            return redirect('/post/'.$post->slug);
        }
    }

    public function move(Request $request){
        $posts_array = explode(',', $request->input('list'));

        Post::whereIn('id', $posts_array)
            ->update([
                'updated_at' => now(),
                'status' => $request->input('direction')
            ]);
    }
}
