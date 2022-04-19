<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
 * @property mixed $type
 * @property mixed $id
 * @property mixed $status
 * @property mixed $excerpt
 */
class Post extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'excerpt', 'body', 'user_id', 'category_id'];

    public function author()
    {
        if($this->user_id == null){
            return null;
        }   else{
            return User::find($this->user_id);
        }
    }

    public function category()
    {
	    return $this->belongsTo(Category::class);
    }

    public function tags($category_id = null)
    {
        if($category_id == null){
            return $this->belongsToMany(Tag::class)->get();
        }   else{
            return $this->belongsToMany(Tag::class)->where('category_id', $category_id)->get();
        }
    }

    public function existMoreComments($last_comment_id = 0){
        $comment_block = Comment::where('post_id', $this->id)
            ->whereNull('reply_id');

        if($last_comment_id > 0){
            $comment_block = $comment_block->where('id', '<', $last_comment_id);
        }

        return count($comment_block->get());
    }

    public function commentsCount()
    {
        return Comment::where('post_id', $this->id)
            ->count();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('reply_id');
    }

    public function commentsList($last_comment_id = 0)
    {
        $comments = Comment::leftJoin('users', 'users.id', '=', 'comments.user_id')
            ->where('post_id', $this->id)
            ->whereNull('reply_id')
            ->select([
                'comments.*',
                'users.name as author_name',
                'users.thumbnail as author_thumbnail'
            ]);

        if($last_comment_id > 0){
            $comments = $comments->where('comments.id', '<', $last_comment_id);
        }

        return $comments->orderBy('created_at', 'DESC')
            ->limit(10)
            ->get();
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

    public function body($type = 'full', $limit = 0): string
    {
        if($type == 'full'){
            // Full content render;
            $content = static::jsonToHtml($this->body);
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
      $video_path = '/public'.config('images.videos_storage_path');

        switch($type){
            // Main;
            case 'main':
                Storage::delete($path.$this->original['original']);
                Storage::delete($path.$this->medium);
                Storage::delete($path.$this->thumbnail);

                // Of this post have video type - we must remove video file too;
                if($this->type == 'video'){
                    // Get video from paths from table;
                    $videos = DB::table('posts_videos')
                        ->where('post_id', $this->id)
                        ->get();

                    foreach($videos as $video){
                        Storage::delete($video_path.$video->original);
                        Storage::delete($video_path.$video->medium);
                        Storage::delete($video_path.$video->thumbnail);
                    }

                    // Then we need to remove writes in DB;
                    DB::table('posts_videos')
                        ->where('post_id', $this->id)
                        ->delete();
                }
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
    // HTML to text conversion
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

    static function jsonToHtml($jsonStr) {
        $obj = json_decode($jsonStr);

        $html = '';
        foreach ($obj->blocks as $block) {
            switch ($block->type) {
                case 'paragraph':
                    $html .= '<p>' . $block->data->text . '</p>';
                    break;

                case 'header':
                    $html .= '<h'. $block->data->level .'>' . $block->data->text . '</h'. $block->data->level .'>';
                    break;

                case 'raw':
                    $html .= $block->data->html;
                    break;

                case 'list':
                    $lsType = ($block->data->style == 'ordered') ? 'ol' : 'ul';
                    $html .= '<' . $lsType . '>';
                    foreach($block->data->items as $item) {
                        $html .= '<li>' . $item . '</li>';
                    }
                    $html .= '</' . $lsType . '>';
                    break;

                case 'code':
                    $html .= '<pre><code class="language-'. $block->data->lang .'">'. $block->data->code .'</code></pre>';
                    break;

                case 'image':
                    $html .= '<div class="img_pnl padding-y-md"><img class="radius-lg" src="'. $block->data->file->url .'" /></div>';
                    break;

                case 'embed':
                    $html .= '<iframe src="'.$block->data->embed.'" style="width:100%; height: 600px" scrolling="no" frameborder="no"></iframe>';
                    break;

                case 'extUrl':
                    if($block->data->type == 'image'){
                        $html .= '<div class="img_pnl padding-y-md custom-ext-url-result-on-render"><img src="'.$block->data->url.'" alt="ext-url-image"></div>';
                    }

                    if($block->data->type == 'video'){
                        $html .= '<div class="img_pnl padding-y-md custom-ext-url-result-on-render"><video controls="controls" preload="metadata"><source src="'.$block->data->url.'" type="video/mp4"></video></div>';
                    }
                    break;

                default:
                    break;
            }
        }

        return '<div style="text-align: left">'.$html.'</div>';
    }

    public function addViewHistory($ip, $user_agent){
        $user_id = Auth::guest() ? null : Auth::id();

        // Check user view for this post;
        $exist_views = DB::table('posts_views')
            ->where('post_id', $this->id)
            ->where('ip', $ip)
            ->where('user_agent', $user_agent);

        if($user_id == null){
            $exist_views = $exist_views->whereNull('viewer_id');
        }   else{
            $exist_views = $exist_views->where('viewer_id', $user_id);
        }

        $exist_views = $exist_views->first();

        if($exist_views == null){
            DB::table('posts_views')
                ->insert([
                    'post_id' => $this->id,
                    'viewer_id' => $user_id,
                    'ip' => $ip,
                    'user_agent' => $user_agent,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
        }
    }

    public function getViewsCount(): int
    {
        return DB::table('posts_views')
            ->where('post_id', $this->id)
            ->count();
    }

    public function getRecentList($by_array, $limit = 5){
        $posts = Post::where('status', 'published')
            ->where('id', '!=', $this->id);

        $posts_ids = [];
        foreach($by_array as $by_item){
            switch($by_item){
                case 'tags':
                    // Getting post_tags;
                    $tags = DB::table('post_tag')
                        ->where('post_id', $this->id)
                        ->get();

                    $tags_ids = [];
                    foreach($tags as $tag){
                        $tags_ids[] = $tag->tag_id;
                    }

                    // Getting other posts with same tag;
                    $posts_data = DB::table('post_tag')
                        ->whereIn('tag_id', $tags_ids)
                        ->where('post_id', '!=', $this->id)
                        ->get();

                    foreach($posts_data as $post){
                        $posts_ids[] = $post->post_id;
                    }
                    break;

                case 'title':
                    // Prepare title;
                    $like_title = str_replace(' ', '%', $this->title);
                    $posts_data = Post::where('title', 'like', "%$like_title%")
                        ->where('id', '!=', $this->id)
                        ->get();

                    foreach($posts_data as $post){
                        $posts_ids[] = $post->id;
                    }
                    break;
            }
        }

        return $posts->whereIn('id', $posts_ids)
            ->inRandomOrder()
            ->latest()
            ->take($limit)
            ->get();
    }
}
