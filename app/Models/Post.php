<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Agent\Agent;

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
 * @property false|mixed|string $file_hash
 * @property mixed|null $post_date
 * @property mixed|null $created_at
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
        $comments = Comment::whereNull('reply_id')
            ->where('post_id', $this->id);

        if($last_comment_id > 0){
            $comments = $comments->where('comments.id', '<', $last_comment_id);
        }

        $comments = $comments->orderBy('created_at', 'DESC')
            ->limit(10)
            ->get();

        $authors = [];
        foreach($comments as $comment){
            if(!isset($authors[$comment->user_id])){
                $authors[$comment->user_id] = User::find($comment->user_id);
            }

            $comment->author = $authors[$comment->user_id];
        }

        return $comments;
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
            $content = static::jsonToHtml($this->body, 'post');
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
      $galleries = '/public'.config('images.galleries_storage_path');
      $video_path = '/public'.config('images.videos_storage_path');

        switch($type){
            // Gallery;
            case 'gallery':
                if($this->type == 'gallery'){
                    Storage::deleteDirectory($galleries.'/'.$this->slug);
                }
                break;

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

    static function jsonToHtml($jsonStr, $type = 'post') {
        $obj = json_decode($jsonStr);

        $html = '';
        foreach ($obj->blocks as $block) {
            switch ($block->type) {
                case 'paragraph':
                    $html .= '<p class="'.$type.'-paragraph">' . $block->data->text . '</p>';
                    break;

                case 'header':
                    $html .= '<h'. $block->data->level .' class="'.$type.'-header">' . $block->data->text . '</h'. $block->data->level .'>';
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
                    $html .= '<div class="img_pnl padding-y-md '.$type.'-image"><img class="radius-lg" src="'. $block->data->file->url .'" /></div>';
                    break;

                case 'embed':
                    $html .= '<iframe src="'.$block->data->embed.'" style="width:100%; height: 600px" scrolling="no" frameborder="no"></iframe>';
                    break;

                case 'extUrl':
                    if($block->data->type == 'image'){
                        $html .= '<div class="img_pnl padding-y-md custom-ext-url-result-on-render '.$type.'-ext-image"><img class="radius-lg" src="'.$block->data->url.'" alt="ext-url-image"></div>';
                    }

                    if($block->data->type == 'video'){
                        $html .= '<div class="img_pnl padding-y-md custom-ext-url-result-on-render '.$type.'-ext-video"><video controls="controls" preload="metadata"><source src="'.$block->data->url.'" type="video/mp4"></video></div>';
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
            ->where('posts.category_id', '!=', 2)
            ->where('posts.id', '!=', $this->id);

        foreach($by_array as $by_item){
            switch($by_item){
                case 'tags':
                    $post_tags = DB::table('post_tag')
                        ->where('post_id', $this->id)
                        ->get();

                    $post_tags_in = [];
                    foreach($post_tags as $post_tag){
                        $post_tags_in[] = $post_tag->tag_id;
                    }

                    // Getting other posts with same tag;
                    $posts = $posts->leftJoin(DB::raw('(
                        select post_id from post_tag
                        where tag_id in ('.implode(',', $post_tags_in).')
                        and `post_id` != '.$this->id.'
                        group by post_id
                    ) as post_tag'), 'post_tag.post_id', '=', 'posts.id');

                    break;

                case 'title':
                    // Prepare title;
                    $like_title = str_replace(' ', '%', $this->title);
                    if(count($by_array) > 1){
                        $posts = $posts->orWhere('title', 'like', "%$like_title%");
                    }   else{
                        $posts = $posts->where('title', 'like', "%$like_title%");
                    }

                    break;
            }
        }

        return $posts->select('posts.*')
            ->inRandomOrder()
            ->latest()
            ->take($limit)
            ->get();
    }

    public static function getPostsListByView($period = null){
        switch($period){
            case 'day':
                $add_where = "where created_at between '".date('Y-m-d', strtotime(date('Y-m-d').' -1 days'))." 00:00:00' and '".date('Y-m-d')." 23:59:59'";
                break;

            case 'week':
                $add_where = "where created_at between '".date('Y-m-d', strtotime(date('Y-m-d').' -7 days'))." 00:00:00' and '".date('Y-m-d')." 23:59:59'";
                break;

            case 'month':
                $add_where = "where created_at between '".date('Y-m-d', strtotime(date('Y-m-d').' -1 months'))." 00:00:00' and '".date('Y-m-d')." 23:59:59'";
                break;

            case 'year':
                $add_where = "where created_at between '".date('Y-m-d', strtotime(date('Y-m-d').' -1 years'))." 00:00:00' and '".date('Y-m-d')." 23:59:59'";
                break;

            default:
                $add_where = '';
        }

        return static::select(['posts.*', 'views.views_count'])
            ->leftJoin(DB::raw('(
                    select post_id, count(*) as views_count
                    from posts_views
                    '.$add_where.'
                    group by post_id
                ) as views'), 'views.post_id', 'posts.id')
            ->whereNotNull('user_id')
            ->whereNotNull('views_count')
            ->where('status', 'published')
            ->where('posts.category_id', '!=', 2)
            ->orderBy('views_count', 'DESC')
            ->limit(10)
            ->get();
    }

    static public function autoTitle($tags_in_cats){
        // Get title template;
        $template = config('posts.auto_title_template');
        // Render title from tags;
        $title_array = [];
        $str_block_count = 0;
        foreach ($template as $template_item) {
            if (!isset($template_item['category_id'])) {
                $title_array[] = implode($template_item);
                $str_block_count++;
                continue;
            }

            $cat_request_name = 'tag_category_' . $template_item['category_id'];

            if (isset($tags_in_cats[$cat_request_name])) {
                $cat_in_request = $tags_in_cats[$cat_request_name];
                $rand_array = [];
                $limit = min($template_item['limit'], count($cat_in_request));
                for ($i = 0; $i < $limit ; $i++) {
                    if(is_numeric($cat_in_request[$i])){
                        $tag = Tag::find($cat_in_request[$i]);
                        if($tag !== null) $rand_array[] = $tag->name;
                    }   else{
                        $rand_array[] = $cat_in_request[$i];
                    }
                }
                if (count($rand_array) > 0) {
                    $title_array[] = implode(' ', $rand_array);
                }
            }   else{
                $title_array[] = null;
            }
        }

        // Little fix for title;
        foreach($title_array as $key => $item){
            if($item == null){
                unset($title_array[$key]);
                if(isset($title_array[$key-1])){
                    unset($title_array[$key-1]);
                    $str_block_count--;
                }
            }

            if($item == ' '){
                unset($title_array[$key]);
                $str_block_count--;
            }
        }

        return [
            'title_array' => $title_array,
            'str_block_count' => $str_block_count
        ];
    }

    public static function getListByTagName($tag_name, $order = ['by' => 'created_at', 'order' => 'desc'], $limit = 10){
        $tags = Tag::where('name', $tag_name)
            ->get();

        $tags_ids = [];
        foreach($tags as $tag){
            $tags_ids[] = $tag->id;
        }

        $post_tags = DB::table('post_tag')
            ->whereIn('tag_id', $tags_ids);

        return static::joinSub($post_tags, 'post_tag', function ($join) {
                $join->on('post_tag.post_id', '=', 'posts.id');
            })
            ->where('posts.status', 'published')
            ->where('posts.category_id', '!=', 2)
            ->orderBy('posts.'.$order['by'], $order['order'])
            ->limit($limit)
            ->get();
    }

    public static function getFilteredListByTagName($filters_tags = [], $only_count = false, $paginate = 0){
        $tags_id = [];
        foreach($filters_tags as $cat_name => $tag_slug){
            $cat = TagsCategories::where('name', $cat_name)
                ->first();

            if($cat == null){
                continue;
            }

            $tag = Tag::where('slug', $tag_slug)
                ->where('category_id', $cat->id)
                ->first();

            if($tag == null){
                continue;
            }

            $tags_id[] = $tag->id;
        }

        $posts_links = DB::select(DB::raw('select post_id, GROUP_CONCAT(tag_id) as tags_group, count(tag_id) as tags_count
                                                    from post_tag
                                                    where tag_id in ('.implode(',', $tags_id).')
                                                    group by post_id'));

        $posts_id = [];
        foreach($posts_links as $link){
            if($link->tags_count == count($tags_id)){
                $posts_id[] = $link->post_id;
            }
        }

        if($only_count){
            return count($posts_id);
        }

        if($paginate > 0){
            return Post::whereIn('id', $posts_id)
                ->paginate($paginate);
        }

        return Post::whereIn('id', $posts_id)
            ->get();
    }

    public function likes(){
        return Like::where('post_id', $this->id);
    }

    public function userLiked(){
        $user_liked = false;
        if(!Auth::guest()){
            foreach($this->likes()->get() as $like){
                if($like->user_id == Auth::id()){
                    $user_liked = true;
                }
            }
        }

        return $user_liked;
    }

    public function prepareContent($image_classes = '', $target = 'post'){
        $content = null;

        if($this->type == 'image' || $this->type == 'news'){
            $content = '<div class="image-zoom js-image-zoom"><img class="'.$image_classes.'" alt="thumbnail" src="'.'/storage'.config('images.posts_storage_path').$this->medium.'"></div>';
        }

        if($this->type == 'gallery'){
            $image_classes = str_replace(['image-zoom__preview', 'js-image-zoom__preview'], '', $image_classes);

            $images = Storage::allFiles('/public/'.config('images.galleries_storage_path').'/'.$this->slug.'/medium/');
            $images_result = [];
            foreach($images as $key => $image){
                $image = str_replace('public/', '/', $image);
                $images_result[] = '<img class="gallery-preview-image" data-item-key="'.($key + 2).'" src="/storage'.$image.'" aria-controls="manga-modal">';
            }

            $content = view('components.posts.show.types.gallery.manga', [
                'post' => $this,
                'image_classes' => $image_classes,
                'images' => $images_result
            ])->render();

            if($target == 'gallery'){
                $content = '<div><a href="'.route('post.show', $this).'"><img class="'.$image_classes.'" alt="thumbnail" src="'.'/storage'.config('images.posts_storage_path').$this->medium.'"></a></div>';
            }
        }

        if($this->type == 'video'){
            $video = DB::table('posts_videos')
                ->where('post_id', $this->id)
                ->first();

            $attached_video = $video->medium;

            $agent = new Agent();
            if($agent->isMobile()){
                $attached_video = $video->thumbnail;
            }

            // Render video player;
            $content = view('admin.posts.script-video-js-player', [
                'poster' => '/storage'.config('images.posts_storage_path').$this->medium,
                'video_mp4' => '/storage'.config('images.videos_storage_path').$attached_video,
                'video_webm' => '/storage'.config('images.videos_storage_path').$attached_video,
                'player_width' => config('images.player_size_original.width'),
                'player_height' => config('images.player_size_original.height'),
                'auto_width' => true
            ])->render();
        }

        return $content;
    }

    public function dropWithContent(){
        // Remove tags links;
        DB::table('post_tag')
            ->where('post_id', $this->id)
            ->delete();

        // Remove all reply comments;
        Comment::where('post_id', $this->id)
            ->whereNotNull('reply_id')
            ->delete();

        // Remove all comment;
        Comment::where('post_id', $this->id)
            ->whereNull('reply_id')
            ->delete();

        // Remove all views;
        DB::table('posts_views')
            ->where('post_id', $this->id)
            ->delete();

        // Remove likes;
        Like::where('post_id', $this->id)
            ->delete();

        // Remove notifications;
        Notification::where('post_id', $this->id)
            ->delete();

        // Favorites;
        DB::table('favorites_items')
            ->where('post_id', $this->id)
            ->delete();

        // Remove post images;
        $this->removePostImages('gallery');
        $this->removePostImages('main');
        $this->removePostImages('body');

        // Remove all video links;
        if($this->type == 'video'){
            DB::table('posts_videos')
                ->where('post_id', $this->id)
                ->delete();
        }

        // And then - remove the post;
        static::destroy($this->id);
    }

    public function listsCount(){
        $lists = DB::table('favorites_items')
            ->where('post_id', $this->id)
            ->select('post_id')
            ->get();

        return count($lists);
    }

    public function userListed(){
        $list_item = DB::table('favorites_items')
            ->leftJoin('favorites', 'favorites.id', '=', 'favorites_items.favorite_id')
            ->where('post_id', $this->id)
            ->where('user_id', Auth::id())
            ->first();

        return $list_item != null;
    }

    public function parseGallery($images){
        $galleries_path = '/public'.config('images.galleries_storage_path');

        foreach($images as $image){
            $image = str_replace(url('/storage'.config('images.galleries_storage_path')).'/_temp/thumbnail/', '', $image);

            if(!Storage::exists($galleries_path.'/'.$this->slug.'/thumbnail/'.$image)){
                Storage::move($galleries_path.'/_temp/thumbnail/'.$image, $galleries_path.'/'.$this->slug.'/thumbnail/'.$image);
                Storage::move($galleries_path.'/_temp/original/'.$image, $galleries_path.'/'.$this->slug.'/original/'.$image);
                Storage::move($galleries_path.'/_temp/medium/'.$image, $galleries_path.'/'.$this->slug.'/medium/'.$image);
            }
        }

        // Reset images names;
        $medias = ['original', 'thumbnail', 'medium'];

        foreach($medias as $media){
            $images_files = Storage::allFiles($galleries_path.'/'.$this->slug.'/'.$media.'/');

            foreach($images_files as $image){
                $temp = explode('_', basename($image));
                $new_image = $temp[count($temp) - 1];

                if(!Storage::exists($galleries_path.'/'.$this->slug.'/'.$media.'/'.basename($new_image))){
                    Storage::move($image, $galleries_path.'/'.$this->slug.'/'.$media.'/'.basename($new_image));
                }
            }
        }

        foreach($medias as $media){
            foreach($images as $key => $image){
                $temp = explode('_', basename($image));
                $new_image = $key.'_'.$temp[count($temp) - 1];

                Storage::move($galleries_path.'/'.$this->slug.'/'.$media.'/'.$temp[count($temp) - 1], $galleries_path.'/'.$this->slug.'/'.$media.'/'.$new_image);
            }
        }
    }

    public function moveGallery($new_slug){
        $galleries_path = '/public'.config('images.galleries_storage_path');
        $medias = ['original', 'thumbnail', 'medium'];

        foreach($medias as $media){
            $images = Storage::allFiles('/public/'.config('images.galleries_storage_path').'/'.$this->slug.'/'.$media.'/');

            foreach($images as $image){
                Storage::move($image, $galleries_path.'/'.$new_slug.'/'.$media.'/'.basename($image));
            }
        }

        Storage::deleteDirectory($galleries_path.'/'.$this->slug);
    }

    public function getPreviewImage($target = 'thumbnail'){
        return config('images.posts_storage_path').$this->$target;
        /*
        if($this->type == 'gallery'){
            $images = Storage::allFiles('/public/'.config('images.galleries_storage_path').'/'.$this->slug.'/'.$target.'/');

            if(count($images) > 0){
                $image = str_replace('public/galleries/', '/', $images[0]);

                return config('images.galleries_storage_path').'/'.$image;
            }

            return '';
        }   else{
            return config('images.posts_storage_path').$this->$target;
        }
        */
    }

    public function getGalleryLength(){
        $images = Storage::allFiles('/public/'.config('images.galleries_storage_path').'/'.$this->slug.'/medium/');

        return count($images) + 1;
    }

    public static function getCounters(){
        $counters = static::groupBy('status')
            ->selectRaw('status, count(*) as value');

        if(!Gate::allows('is-admin')){
            $counters = $counters->where('user_id', Auth::id());
        }

        $counters = $counters->get();

        $result = [];
        $total = 0;
        foreach($counters as $counter){
            $result[$counter->status] = $counter->value;
            $total += $counter->value;
        }

        $counters_status_list = [
            'pre-published', 'draft', 'pending', 'published', 'trash', 'total'
        ];


        foreach($counters_status_list as $status){
            if(!isset($result[$status])){
                $result[$status] = $status != 'total' ? 0 : $total;
            }
        }

        return $result;
    }

    public function renameAllContentInTitle(){
        $work_array = ['original', 'medium', 'thumbnail'];

        switch($this->type){
            case 'image':
            case 'news':
                foreach($work_array as $type){
                    $filename = explode('.', basename($this[$type]));
                    $filename = $this->slug.'.'.$filename[1];
                    if(!Storage::exists('public'.config('images.posts_storage_path').'/'.$type.'/'.$filename)){
                        Storage::move('public'.config('images.posts_storage_path').$this[$type], 'public'.config('images.posts_storage_path').'/'.$type.'/'.$filename);
                        $this[$type] = '/'.$type.'/'.$filename;
                        $this->save();
                    }
                }
                break;

            case 'video':
                foreach($work_array as $type){
                    // Preview image;
                    $filename = explode('.', basename($this[$type]));
                    $filename = $this->slug.'.'.$filename[1];
                    if(!Storage::exists('public'.config('images.posts_storage_path').'/'.$type.'/'.$filename)){
                        Storage::move('public'.config('images.posts_storage_path').$this[$type], 'public'.config('images.posts_storage_path').'/'.$type.'/'.$filename);
                        $this[$type] = '/'.$type.'/'.$filename;
                        $this->save();
                    }

                    // Videos;
                    $videos = DB::table('posts_videos')
                        ->where('post_id', $this->id)
                        ->get();

                    foreach($videos as $video){
                        $filename = explode('.', basename($video->$type));
                        $filename = $this->slug.'.'.$filename[1];
                        if(!Storage::exists('public'.config('images.videos_storage_path').'/'.$type.'/'.$filename)){
                            Storage::move('public'.config('images.videos_storage_path').$video->$type, 'public'.config('images.videos_storage_path').'/'.$type.'/'.$filename);

                            DB::table('posts_videos')
                                ->where('post_id', $this->id)
                                ->update([
                                    $type => '/'.$type.'/'.$filename
                                ]);
                        }
                    }
                }
                break;

            case 'gallery':
                foreach($work_array as $type){
                    // Main image;
                    $filename = explode('.', basename($this[$type]));
                    $filename = $this->slug.'.'.$filename[1];
                    if(!Storage::exists('public'.config('images.posts_storage_path').'/'.$type.'/'.$filename)){
                        Storage::move('public'.config('images.posts_storage_path').$this[$type], 'public'.config('images.posts_storage_path').'/'.$type.'/'.$filename);
                        $this[$type] = '/'.$type.'/'.$filename;
                        $this->save();
                    }

                    // Other images;
                    $images = Storage::allFiles('/public/'.config('images.galleries_storage_path').'/'.$this->slug.'/'.$type.'/');
                    foreach($images as $key => $image){
                        $filename = explode('.', basename($image));
                        $filename = $key.'_'.$this->slug.'.'.$filename[1];

                        Storage::move('public'.config('images.galleries_storage_path').'/'.$this->slug.'/'.$type.'/'.basename($image), 'public'.config('images.galleries_storage_path').'/'.$this->slug.'/'.$type.'/'.$filename);
                    }
                }

                break;
        }
    }
}
