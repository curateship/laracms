<?php

namespace App\Models;

use EditorJS\EditorJSException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use SaperX\LaravelEditorjsHtml\EditorJSHtml;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed|string $title
 * @property mixed $slug
 * @property array|mixed|string|string[]|null $original
 * @property array|mixed|string|string[]|null $medium
 * @property array|mixed|string|string[]|null $thumbnail
 * @property mixed $category_id
 * @property int|mixed|string|null $user_id
 * @property mixed $body
 */
class Post extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'excerpt', 'body', 'user_id', 'category_id'];

    public function author()
    {
	    return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
	    return $this->belongsTo(User::class);
    }

    public function tags($category_id = null)
    {
        if($category_id == null){
            return $this->belongsToMany(Tag::class)->get();
        }   else{
            return $this->belongsToMany(Tag::class)->where('category_id', $category_id)->get();
        }
    }

    public function comments()
    {
	    return $this->hasMany(Comment::class);
    }

    public function image()
    {
	    return $this->morphOne(Image::class, 'imageable');
    }

    public static function getNewSlug($slug, $posts) {
      $max_number = 0;
      foreach($posts as $post) {
          $slug_snippet = str_replace($slug, "", $post->slug);

          if (!empty($slug_snippet) && substr($slug_snippet, 0, 1) === '-') {
              $slug_snippet = substr($slug_snippet, 1);
              if (ctype_digit($slug_snippet)) {
                  $max_number = max($max_number, (int)$slug_snippet);
              }
          }
      }

      if ($max_number === 0) $max_number = 2;
      else $max_number++;

      return $slug . '-' . $max_number;
  }

    /**
     * @throws EditorJSException
     */
    public function body($type = 'full'): string
    {
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

        return html_entity_decode($content);
    }

  public function removePostImages($type){
      $path = '/public'.config('images.posts_storage_path');

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
}
