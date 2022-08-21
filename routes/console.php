<?php

use App\Models\Post;
use App\Models\ScraperStat;
use App\Models\Tag;
use App\Models\User;
use App\Services\ScraperService;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\FFMpeg;
use FFMpeg\Coordinate;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Scraper;
use App\Models\ScraperLog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('test', function () {
    dump('Nothing to test now');
})->purpose('Method for tests');

Artisan::command('posts:slug-title', function () {
    dump('Start renaming storage images for posts...');
    $posts = Post::all();
    foreach($posts as $post){
        $post->renameAllContentInTitle();
        dump('Post with ID: '.$post->id.' is ready.');
    }
    dump('Renaming successfully finished.');
})->purpose('Rename storage images for posts.');

Artisan::command('tags:slug', function () {
    $tags = Tag::whereNull('slug')
        ->get();

    foreach($tags as $tag){
        $slug = Str::slug($tag->name, '-');
        $exist = Tag::where('slug', 'like', $slug . '%')
            ->get();

        if (count($exist) > 0) {
            $slug = Post::getNewSlug($slug, $exist);
        }
        $tag->slug = $slug;
        $tag->save();
    }
})->purpose('Add slugs to tags');

Artisan::command('storage:hash', function(){
    $posts = Post::whereNull('file_hash')
        ->get();

    foreach($posts as $post){
        $file = '';

        if($post->type == 'image'){
            $path = config('images.posts_storage_path');
            $file = $path.$post->original;
        }

        if($post->type == 'video'){
            $path = config('images.videos_storage_path');
            $video = \Illuminate\Support\Facades\DB::table('posts_videos')
                ->where('post_id', $post->id)
                ->first();

            if($video != null){
                $file = $path.$video->original;
            }   else{
                dump("ERROR: Cant resolve video file path! Post with ID $post->id was been skipped.");
                continue;
            }
        }

        $file_real_path = storage_path('app/public'.$file);
        if(file_exists($file_real_path)){
            $hash = hash_file('md5', $file_real_path);
            Post::where('id', $post->id)
                ->update([
                    'file_hash' => $hash
                ]);
            dump("Original file has $hash successfully added for post with ID $post->id");
        }   else{
            dump("ERROR: Cant resolve file by path! Post with ID $post->id was been skipped.");
        }
    }
})->purpose('Add original file hash for exist posts');

Artisan::command('user-rename', function () {
    $users = User::where('username', '')
        ->get();

    foreach($users as $user){
        $user->username = 'user'.$user->id;
        $user->save();
    }
})->purpose('Add username for users without them.');

Artisan::command('auto-title', function () {
    $posts = Post::where('status', 'draft')
        ->get();

    foreach($posts as $post){
        // Get post tags in cats;
        $tags = Tag::leftJoin('post_tag', 'post_tag.tag_id', '=', 'tags.id')
            ->leftJoin('tags_categories', 'tags_categories.id', '=', 'tags.category_id')
            ->where('post_id', $post->id)
            ->selectRaw('CONCAT("tag_category_", category_id) as cat_id, tags.id as tag_id')
            ->get();

        $tags_in_cats = [];
        foreach($tags as $tag){
            $tags_in_cats[$tag->cat_id][] = $tag->tag_id;
        }

        $title_result = Post::autoTitle($tags_in_cats);

        $title = implode(' ', $title_result['title_array']);
        if (count($title_result['title_array']) == $title_result['str_block_count']) {
            // No tags? Nothing to do;
            dump('Post with ID: '.$post->id.' has no need to rename');
            continue;
        }

        $post->title = $title;
        $post->save();

        dump('Post with ID: '.$post->id.' successfully renamed');
    }

    dump('All drafts was renamed!');
})->purpose('For automatic draft posts rename');

Artisan::command('scrape {scraper_id}', function () {
    $scraper_settings = [
        'scraper_ip_ports' => [],
        'delay_min' => 5,
        'delay_max' => 15
    ];

    $scraper_id = intval($this->argument('scraper_id'));
    if ($scraper_id > 0) {
        $scraper = Scraper::find($scraper_id);
        if ($scraper) {
            // Do Scrape action.
            Log::info('Run Scraper by id (' . $scraper_id . ') - ' . date("Y-m-d H:i:s") );

            // Add/Update scraper status info into stats table
            if ($scraper->last_page_url == null) {
                $scraper->last_page_url = $scraper->default_url;
                $scraper->save();
            }

            $scraper_service = new ScraperService($scraper, $scraper_settings);
            $scraper_service->run();
            Log::info('Scraper finished working - ' . date("Y-m-d H:i:s") );
        }
    } else {
        Log::info('Run Re-Scraper - ' . date("Y-m-d H:i:s") );

        // Get all logs item from logs table.
        $logs = ScraperLog::all();
        foreach($logs as $log) {
            // ignore log item have empty `url` column.
            if (!empty($log->url)) {
                $scraper = Scraper::find($log->scraper_id);
                if ($scraper) {
                    // Do custom scrape action.
                    $scraper_service = new ScraperService($scraper, $scraper_settings);
                    $scraper_service->retry($log);
                }
            } else {
                ScraperLog::where('id', $log->id)->delete();
            }
        }

        Log::debug('Completed run Re-Scraper - ' . date("Y-m-d H:i:s") );
    }

    return 0;
})->purpose('Run scrapper command');
