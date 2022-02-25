<?php

namespace App\Http\Controllers\Admin;

// Others
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Tag;
use Illuminate\Http\Request;

// Models
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminPostController extends Controller
{
    // Index
    public function index(Request $request)
    {
        if($request->has('sortBy') && $request->input('sortBy') !== 'role'){
            $posts = Post::orderBy($request->input('sortBy'), $request->input('sortDesc'));
        }   else{
            $posts = Post::orderBy('created_at', 'DESC');
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

    public function show($id)
    {
        //
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

            // And then - remove the post;
            Post::destroy($id);
        }

        if(count($ids) > 1){
            $request->session()->flash('success', 'You have deleted all selected posts');
        }   else{
            $request->session()->flash('success', 'You have deleted the post');
        }
    }

    public function upload(Request $request){
        $path = '/public'.config('images.posts_storage_path');
        $mime_type = $request->file('file')->getMimeType();
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
        $original = request()->file('file')->store($path."/original");

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

                $thumbnail_medium->writeImages($media_path . "$path/$type_name/" . $thumbnail_medium_name, true);
            }   else{
                /* Other Image types */
                $thumbnail_medium = \Intervention\Image\Facades\Image::make(request()->file('file'));
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

        return $media;
    }

    // Store or update;
    public function store(Request $request){
        $title = strip_tags($request->input('title'));

        // Generate slug
        $slug = Str::slug($title, '-');
        $post_with_same_slug = Post::where('slug', $slug)->first();

        if ($post_with_same_slug) {
            // Ignore, if we have same post with this slug;
            if($request->has('postId') && $request->input('postId') != $post_with_same_slug->id){
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

            // Removing old tags links;
            DB::table('post_tag')
                ->where('post_id', $post->id)
                ->delete();
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
        if($request->has('tags')){
            foreach ($request->input('tags') as $tag_input) {
                if(is_numeric($tag_input)){
                    $tag = Tag::where('id', $tag_input)
                        ->first();
                }   else{
                    $tag = Tag::where('name', $tag_input)
                        ->first();
                }

                // If tag doesn't exist yet, create it;
                if ($tag == null) {
                    $tag = new Tag;
                    $tag->name = $tag_input;
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

        if($request->has('postId')){
            return redirect('/post/edit/'.$post->slug);
        }   else{
            return redirect('/post/'.$post->slug);
        }

    }
}
