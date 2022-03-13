<?php

namespace App\Http\Controllers\Admin;

// Others
use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\TagsCategories;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

// Models
use App\Models\Post;
use App\Models\User;
use App\Models\Category;

// Support
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Imagick;
use Intervention\Image\Facades\Image;

class AdminTagController extends Controller
{
    private $rules = [
        'name' => 'required|min:3|max:30',
    ];

    // Index
    public function index(Request $request)
    {
        SEOMeta::setTitle(config('seotools.static_titles.'.get_called_class().'.'.__FUNCTION__));
        if($request->has('sortBy') && $request->input('sortBy') !== 'role'){
            $tags = Tag::orderBy($request->input('sortBy'), $request->input('sortDesc'));
        }   else{
            $tags = Tag::orderBy('created_at', 'DESC');
        }

        return view('admin.tags.index', [
            'tags' => $tags->paginate(10),
        ]);
    }

    // Create
    public function create()
    {
        return view('admin.tags.create');
    }

    // Destroy
    public function destroy(string $ids, Request $request)
    {
        $ids = explode(',', $ids);

        foreach($ids as $id){
            // Remove tags links;
            DB::table('post_tag')
                ->where('tag_id', $id)
                ->delete();

            // Remove tags images;
            $tag = Tag::find($id);
            $tag->removeTagImages();

            // Remove tags;
            $tag->delete();
        }

        if(count($ids) > 1){
            $request->session()->flash('success', 'You have deleted all selected tags');
        }   else{
            $request->session()->flash('success', 'You have deleted the tag');
        }
    }

    // Upload
    public function upload(Request $request){
        $path = '/public'.config('images.tags_storage_path');
        $mime_type = $request->file('file')->getMimeType();
        $media_path = storage_path() . "/app";
        $media = [
            'original', 'medium', 'thumbnail'
        ];

        foreach($media as $key => $type){
            File::ensureDirectoryExists($media_path . '/public/tags/'.$type);
            $media[$type] = config("images.$type");
            unset($media[$key]);
        }
        unset($media['original']);

        // Save original media file in file system;
        $original = request()->file('file')->getClientOriginalName();
        $thumbnail_medium_name = Str::random(27) . '.' . Arr::last(explode('.', $original));

        $original = request()->file('file')->storeAs($path."/original", $thumbnail_medium_name);

        foreach($media as $type_name => $type){
            if ($mime_type == 'image/gif') {
                /* GIF */
                $thumbnail_medium = new Imagick($media_path.'/'.$original);
                $thumbnail_medium = $thumbnail_medium->coalesceImages();
                do {
                    $thumbnail_medium->resizeImage( $type['width'], $type['height'], Imagick::FILTER_BOX, 1, true );
                } while ( $thumbnail_medium->nextImage());

                $thumbnail_medium = $thumbnail_medium->deconstructImages();

                $thumbnail_medium->writeImages($media_path . "/public/tags/$type_name/" . $thumbnail_medium_name, true);
            }   else{
                /* Other Image types */
                $thumbnail_medium = Image::make(request()->file('file'));
                $thumbnail_medium->resize($type['width'], $type['height'], function($constraint){
                    $constraint->aspectRatio();
                });


                $thumbnail_medium->save($media_path . "/public/tags/$type_name/" . $thumbnail_medium_name);
            }

            $media[$type_name]['path'] = $media_path . "/public/tags/$type_name/" . $thumbnail_medium_name;
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
    public function store(Request $request)
    {
        // Get category;
        $category = TagsCategories::where('name', $request->input('tag_category'))
            ->first();

        // Checking this tag on exist;
        $exist_tag = Tag::where('name', $request->input('name'))
            ->where('category_id', $category->id)
            ->first();

        if($exist_tag != null){
            if(!$request->has('tag_id') || ($request->has('tag_id') && $exist_tag->id != $request->input('tag_id'))){
                $request->session()->flash('success', 'Tag with such name in selected category already exist');
                return back();
            }
        }

        if($request->has('tag_id')){
            $tag = Tag::find($request->input('tag_id'));
            $request->session()->flash('success', 'You have created the tag');
        }   else{
            $tag = new Tag();
            $request->session()->flash('success', 'You have update the tag');
        }

        $tag->name = $request->input('name');
        $tag->category_id = $category->id;

        $original = ( $request->has('original') && !empty($request->input('original')) ) ? $request->input('original') : NULL;
        $original = str_replace(url('/storage'.config('images.tags_storage_path')), '', $original);

        $thumbnail = ( $request->has('thumbnail') && !empty($request->input('thumbnail')) ) ? $request->input('thumbnail') : NULL;
        $thumbnail = str_replace(url('/storage'.config('images.tags_storage_path')), '', $thumbnail);

        $medium = ( $request->has('medium') && !empty($request->input('medium')) )  ? $request->input('medium') : NULL;
        $medium = str_replace(url('/storage'.config('images.tags_storage_path')), '', $medium);

        if($request->has('tag_id')){
            if($tag->original != $original){
                $tag->removeTagImages();
            }
        }

        $tag->original = $original;
        $tag->thumbnail = $thumbnail;
        $tag->medium = $medium;
        $tag->save();

        return redirect(route('admin.tags.index'));
    }

    // Edit
    public function edit($id)
    {
        $tag = Tag::find($id);

        if($tag == null){
            return abort(404);
        }

        return view('admin.tags.edit', [
                'tag' => $tag
            ]);
    }
}
