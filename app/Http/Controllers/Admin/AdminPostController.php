<?php

namespace App\Http\Controllers\Admin;

// Others
use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Notification;
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

        //$posts = $posts->where('type', '!=', 'gallery');

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

        $content = null;
        $posts_files = [];
        $posts_urls = [];

        if($post->type == 'image'){
            // Render simple image box;
            $content = '<img alt="thumbnail" src="'.'/storage'.config('images.posts_storage_path').$post->thumbnail.'">';
        }

        if($post->type == 'gallery'){
            $images = Storage::allFiles('/public/'.config('images.galleries_storage_path').'/'.$post->slug.'/thumbnail/');

            foreach($images as $image){
                $image = str_replace('public/galleries/', '/', $image);

                $posts_files[] = str_replace('/'.$post->slug.'/thumbnail/', '', $image);
                $posts_urls[] = url('/storage'.config('images.galleries_storage_path').$image);
            }

            $content = [];
            foreach($images as $image){
                $image = str_replace('public/', '/', $image);

                $content[] = '<img alt="thumbnail" src="'.'/storage'.$image.'">';
            }
            $content = implode('', $content);
        }

        if($post->type == 'video'){
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
            'categories' => Category::pluck('name', 'id'),
            'posts_files' => $posts_files,
            'posts_urls' => $posts_urls
        ]);
    }

    // Destroy
    public function destroy(string $ids, Request $request)
    {

        $ids = explode(',', $ids);

        foreach($ids as $id){
            $post = Post::find($id);
            $post->dropWithContent();
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

        // Clean response array;
        foreach($media as $key => $item){
            $media[$key]['path'] = url('/').Storage::url(str_replace($media_path.'/', '', $item['path']));
            unset($media[$key]['width']);
            unset($media[$key]['height']);
        }

        $media['original']['path'] = url('/').Storage::url($original);
        $media['content'] = '<img alt="thumbnail" src="'.$media['thumbnail']['path'].'">';

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
        if($request->has('status') && $request->input('status') == 'delete'){
            $post = Post::find($request->input('postId'));

            if(Auth::id() == $post->user_id || Gate::allows('is-admin')){
                $post->dropWithContent();

                return redirect('/posts');
            }

            return abort(404);
        }

        $title = strip_tags($request->input('title'));

        // Generate slug
        $slug = Str::slug($title, '-');
        $posts_with_same_slug = Post::where('slug', 'like', $slug . '%');

        if($request->has('postId')){
            $posts_with_same_slug = $posts_with_same_slug->where('id', '!=', $request->input('postId'));
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

        if($request->has('postId') && $post->slug != $slug && $post->type == 'gallery'){
            $post->moveGallery($slug);
        }

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

        $post_date = date('Y-m-d', strtotime(str_replace('/', '.', $request->input('post_date'))));
        if($request->input('status') == 'published' || $request->input('status') == ''){
            // If post date less than current date;
            if(strtotime($post_date) < time()){
                $post->post_date = $post_date;
                $post->created_at = $post_date;
                $post->status = 'published';
            }

            // If post date more than current date;
            if(strtotime($post_date) > time()){
                $post->post_date = $post_date;
                $post->status = 'pre-published';
            }

            // If we do not have post_date;
            if(!$request->has('post_date')){
                $post->post_date = null;
            }
        }

        $post->save();

        if($request->input('status') == 'published'){
            $post->created_at = now();
        }

        // Now we can save excerpt;
        $post->excerpt = strip_tags($post->body('short', 200));
        $post->save();

        // Gallery;
        if($request->input('type') == 'gallery'){
            $post->parseGallery($request->input('uploaded-images'));
        }

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

                    if($post->status != 'pre-published'){
                        $user->followersBroadcast(Auth::user()->name, 'Updated a post: '.$post->title, '/post/'.$post->slug, $post->id);
                    }
                }   else{
                    if($post->status != 'pre-published'){
                        $user->followersBroadcast(Auth::user()->name, 'Added a new post: '.$post->title, '/post/'.$post->slug, $post->id);
                    }
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
                'created_at' => now(),
                'updated_at' => now(),
                'status' => $request->input('direction')
            ]);
    }

    public function getUploadForm($type){
        switch($type){
            case 'image':
                return view('admin.forms.image')->render();
            case 'video':
                return view('admin.forms.video')->render();
            case 'gallery':
                return view('admin.forms.gallery')->render();
        }

        return false;
    }
}
