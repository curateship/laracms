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
	    return $this->hasMany(Comment::class)->whereNull('reply_id');
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
    public function body($type = 'full', $limit = 0): string
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

        //dd($content);
        if($limit > 0){
            return static::truncateHtml(html_entity_decode($content), $limit);
        }   else{
            return html_entity_decode($content);
        }
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

    public static function truncateHtml($text, $length = 100, $ending = '...', $exact = true, $considerHtml = true): string
    {
        if ($considerHtml) {
            // if the plain text is shorter than the maximum length, return the whole text
            if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
                return $text;
            }
            // splits all html-tags to scanable lines
            preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);
            $total_length = strlen($ending);
            $open_tags = array();
            $truncate = '';
            foreach ($lines as $line_matchings) {
                // if there is any html-tag in this line, handle it and add it (uncounted) to the output
                if (!empty($line_matchings[1])) {
                    // if it's an "empty element" with or without xhtml-conform closing slash
                    if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
                        // do nothing
                        // if tag is a closing tag
                    } else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
                        // delete tag from $open_tags list
                        $pos = array_search($tag_matchings[1], $open_tags);
                        if ($pos !== false) {
                            unset($open_tags[$pos]);
                        }
                        // if tag is an opening tag
                    } else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
                        // add tag to the beginning of $open_tags list
                        array_unshift($open_tags, strtolower($tag_matchings[1]));
                    }
                    // add html-tag to $truncate'd text
                    $truncate .= $line_matchings[1];
                }
                // calculate the length of the plain text part of the line; handle entities as one character
                $content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
                if ($total_length+$content_length> $length) {
                    // the number of characters which are left
                    $left = $length - $total_length;
                    $entities_length = 0;
                    // search for html entities
                    if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
                        // calculate the real length of all entities in the legal range
                        foreach ($entities[0] as $entity) {
                            if ($entity[1]+1-$entities_length <= $left) {
                                $left--;
                                $entities_length += strlen($entity[0]);
                            } else {
                                // no more characters left
                                break;
                            }
                        }
                    }
                    $truncate .= substr($line_matchings[2], 0, $left+$entities_length);
                    // maximum lenght is reached, so get off the loop
                    break;
                } else {
                    $truncate .= $line_matchings[2];
                    $total_length += $content_length;
                }
                // if the maximum length is reached, get off the loop
                if($total_length>= $length) {
                    break;
                }
            }
        } else {
            if (strlen($text) <= $length) {
                return $text;
            } else {
                $truncate = substr($text, 0, $length - strlen($ending));
            }
        }
        // if the words shouldn't be cut in the middle...
        if (!$exact) {
            // ...search the last occurance of a space...
            $spacepos = strrpos($truncate, ' ');
            if (isset($spacepos)) {
                // ...and cut the text in this position
                $truncate = substr($truncate, 0, $spacepos);
            }
        }
        // add the defined ending to the text
        $truncate .= $ending;
        if($considerHtml) {
            // close all unclosed html-tags
            foreach ($open_tags as $tag) {
                $truncate .= '</' . $tag . '>';
            }
        }
        return $truncate;
    }
}
