<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * @property mixed $id
 * @property mixed $category_id
 * @property mixed $medium
 * @property mixed $thumbnail
 * @property mixed $name
 * @property mixed $body
 * @property mixed|string $slug
 */
class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug' ,'user_id'];

    public function posts()
    {
        return Post::leftJoin('post_tag', 'post_tag.post_id', '=', 'posts.id')
            ->where('posts.status', 'published')
            ->where('tag_id', $this->id)
            ->select('posts.*');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category(){
        return TagsCategories::find($this->category_id);
    }

    public function useCount(){
        return DB::table('post_tag')
            ->where('tag_id', $this->id)
            ->count();
    }

    public function removeTagImages($type){
        $path = '/public'.config('images.tags_storage_path');

        switch($type){
            // Main;
            case 'main':
                Storage::delete($path.$this->original['original']);
                Storage::delete($path.$this->medium);
                Storage::delete($path.$this->thumbnail);
                break;

            // In body images;
            case 'body':
                $body_array = json_decode($this->body, true);
                foreach($body_array['blocks'] as $block){
                    if($block['type'] == 'image'){
                        $url_array = explode('/', $block['data']['file']['url']);
                        $file_name = Arr::last($url_array);

                        Storage::delete($path.'/original/'.$file_name);
                        Storage::delete($path.'/medium/'.$file_name);
                        Storage::delete($path.'/thumbnail/'.$file_name);
                    }
                }
                break;
        }
    }

    public function body($type = 'full', $limit = 0): string
    {
        if($this->body == ''){
            return '';
        }

        if($type == 'full'){
            // Full content render;
            $content = Post::jsonToHtml($this->body, 'post');
        }   else{
            // Get only text content from post body;
            $data = json_decode($this->body, true);

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
            return \App\Models\Post::truncateHtml(html_entity_decode($content), $limit);
        }   else{
            return html_entity_decode($content);
        }
    }

    public static function getRecommendedTags(){
        $tags = Tag::limit(10)
            ->leftJoin('tags_categories', 'tags_categories.id', '=', 'tags.category_id')
            ->leftJoin(DB::raw("(
                select tag_id, count(*) as posts_count
                from post_tag
                left join (
                    select posts.id as post_id
                    from posts
                    where status = 'published'
                    and user_id != ".Auth::id()."
                ) as posts on posts.post_id = post_tag.post_id
                group by tag_id
            ) as posts"), 'posts.tag_id', '=', 'tags.id')
            ->leftJoin(DB::raw("(
                select follow_tag_id
                from follows
                where user_id = ".Auth::id()."
                and follow_tag_id is not null
            ) as follows"), 'follows.follow_tag_id', '=', 'tags.id')
            ->orderBy('posts_count', 'DESC')
            ->where('posts_count', '>', 0)
            ->select('tags.*', 'follow_tag_id', 'posts_count', 'tags_categories.name as cat_name')
            ->get();

        return $tags;
    }
}
