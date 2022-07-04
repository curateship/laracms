<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * @property int|mixed|string|null $user_id
 * @property mixed $id
 * @property mixed $description
 * @property mixed $title
 * @property mixed $status
 */
class Gallery extends Model
{
    use HasFactory;

    public function parsePosts($images){
        foreach($images as $image){
            $exist_post = Post::where('thumbnail', 'like', '/thumbnail/'.$image)
                ->first();

            if($exist_post != null){
                continue;
            }

            $post = new Post();
            $post->title = '-';
            $post->excerpt = '-';
            $post->slug = '-';
            $post->body = '-';
            $post->category_id = 1;
            $post->user_id = null;
            $post['original'] = '/original/'.$image;
            $post->thumbnail = '/thumbnail/'.$image;
            $post->medium = '/thumbnail/'.$image;
            $post->type = 'gallery_item';
            $post->status = 'gallery_item';
            $post->save();

            DB::table('galleries_posts')
                ->insert([
                    'gallery_id' => $this->id,
                    'post_id' => $post->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
        }
    }

    public function author()
    {
        if($this->user_id == null){
            return null;
        }   else{
            return User::find($this->user_id);
        }
    }

    public function dropWithContent(){
        $posts = DB::table('galleries_posts')
            ->where('gallery_id', $this->id)
            ->get();

        foreach($posts as $post){
            $post = Post::find($post->post_id);
            $post->removePostImages('main');

            DB::table('galleries_posts')
                ->where('gallery_id', $this->id)
                ->where('post_id', $post->id)
                ->delete();

            $post->delete();
        }

        $body_array = json_decode($this->description, true);
        $path = '/public'.config('images.posts_storage_path');
        if(isset($body_array['blocks'])){
            foreach($body_array['blocks'] as $block){
                if($block['type'] == 'image'){
                    $url_array = explode('/', $block['data']['file']['url']);
                    $file_name = Arr::last($url_array);

                    Storage::delete($path.'/original/'.$file_name);
                    Storage::delete($path.'/medium/'.$file_name);
                    Storage::delete($path.'/thumbnail/'.$file_name);
                }
            }
        }

        // And then - remove the gallery;
        static::destroy($this->id);
    }

    public function body($type = 'full', $limit = 0): string
    {
        if($type == 'full'){
            // Full content render;
            $content = Post::jsonToHtml($this->description);
        }   else{
            // Get only text content from post body;
            $data = json_decode($this->description, true);

            $items = [];
            foreach($data['blocks'] as $item){
                if($item['type'] == 'paragraph'){
                    $items[] = $item['data']['text'];
                }
            }

            $content = '<div class="text-left">'.implode('<br>', $items).'</div>';
        }

        //dd($content);
        if($limit > 0){
            return Post::truncateHtml(html_entity_decode($content), $limit);
        }   else{
            return html_entity_decode($content);
        }
    }
}
