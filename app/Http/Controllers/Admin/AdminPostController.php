<?php

namespace App\Http\Controllers\Admin;

// Others
use App\Http\Controllers\Controller;
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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Imagick;

class AdminPostController extends Controller
{
    // Index
    public function index(Request $request)
    {
        SEOMeta::setTitle('Admin Posts');
        if($request->has('sortBy') && $request->input('sortBy') !== 'role'){
            $posts = Post::orderBy($request->input('sortBy'), $request->input('sortDesc'));
        }   else{
            $posts = Post::orderBy('created_at', 'DESC')->with('author');
        }

        return view('admin.posts.index', [
            'posts' => $posts->paginate(10),
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

        if($post == null){
            return abort(404);
        }

        return view('admin.posts.edit', [
            'post' => $post,
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

            // Remove all comments;
            Comment::where('post_id', $id)
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

    // Upload
    public function upload($upload_type, Request $request){
        $path = '/public'.config('images.posts_storage_path');
        $mime_type = $request->file('image')->getMimeType();
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
        $original = request()->file('image')->getClientOriginalName();
        $thumbnail_medium_name = Str::random(27) . '.' . Arr::last(explode('.', $original));

        $original = request()->file('image')->storeAs($path."/original", $thumbnail_medium_name);
        foreach($media as $type_name => $type){
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
                $thumbnail_medium = \Intervention\Image\Facades\Image::make(request()->file('image'));
                $thumbnail_medium->resize($type['width'], $type['height'], function($constraint){
                    $constraint->aspectRatio();
                });


                $thumbnail_medium->save($media_path . "$path/$type_name/" . $thumbnail_medium_name);
            }

            $media[$type_name]['path'] = $media_path . "$path/$type_name/" . $thumbnail_medium_name;
        }

        foreach($media as $key => $item){
            $media[$key]['path'] = url('/').Storage::url(str_replace($media_path.'/', '', $item['path']));
            unset($media[$key]['width']);
            unset($media[$key]['height']);
        }

        $media['original']['path'] = url('/').Storage::url($original);

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
        $post_with_same_slug = Post::where('slug', $slug)->first();

        if ($post_with_same_slug) {
            // Ignore, if we have same post with this slug;
            if(!$request->has('postId') || ($request->has('postId') && $request->input('postId') != $post_with_same_slug->id)){
                $duplicated_slugs = Post::select('slug')->where('slug', 'like', $slug . '%')->orderBy('slug', 'desc')->get();
                $slug = Post::getNewSlug($slug, $duplicated_slugs);
            }
        }

        $category = Category::where('name', $request->input('category'))
            ->first();

        $original = ( $request->has('original') && !empty($request->input('original')) ) ? $request->input('original') : NULL;
        $original = str_replace(url('/storage'.config('images.posts_storage_path')), '', $original);

        $thumbnail = ( $request->has('thumbnail') && !empty($request->input('thumbnail')) ) ? $request->input('thumbnail') : NULL;
        $thumbnail = str_replace(url('/storage'.config('images.posts_storage_path')), '', $thumbnail);

        $medium = ( $request->has('medium') && !empty($request->input('medium')) )  ? $request->input('medium') : NULL;
        $medium = str_replace(url('/storage'.config('images.posts_storage_path')), '', $medium);

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

        $post->title = $title;
        $post->slug = $slug;
        $post->body = $request->input('description');
        $post->category_id = $category->id;
        $post->original = $original;
        $post->thumbnail = $thumbnail;
        $post->medium = $medium;
        $post->save();

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
                        $tag->name = $tag_input;
                        $tag->category_id = $tag_category->id;
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

        if($request->has('postId')){
            return redirect('/post/edit/'.$post->slug);
        }   else{
            return redirect('/post/'.$post->slug);
        }

    }
}
