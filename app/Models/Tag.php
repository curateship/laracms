<?php

namespace App\Models;

use EditorJS\EditorJSException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SaperX\LaravelEditorjsHtml\EditorJSHtml;

/**
 * @property mixed $id
 * @property mixed $category_id
 * @property mixed $medium
 * @property mixed $thumbnail
 * @property mixed $name
 * @property mixed $body
 */
class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug' ,'user_id'];

    public function posts()
    {
        return Post::leftJoin('post_tag', 'post_tag.post_id', '=', 'posts.id')
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

    public function removeTagImages(){
        $path = '/public'.config('images.tags_storage_path');

        Storage::delete($path.$this->original['original']);
        Storage::delete($path.$this->medium);
        Storage::delete($path.$this->thumbnail);
    }

    /**
     * @throws EditorJSException
     */
    public function body($type = 'full', $limit = 0): string
    {
        if($this->body == ''){
            return '';
        }

        if($type == 'full'){
            // Full content render;
            $convertToHtml = new EditorJSHtml($this->body);
            $content = $convertToHtml->render();
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
}
