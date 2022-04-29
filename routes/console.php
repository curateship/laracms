<?php

use App\Models\Post;
use App\Models\Tag;
use App\Services\ScraperService;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\FFMpeg;
use FFMpeg\Coordinate;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use App\Models\Scraper;
use App\Models\ScraperLog;
use Illuminate\Support\Facades\Storage;

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

        $title = implode($title_result['title_array']);
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
            $scraper_service = new ScraperService($scraper, $scraper_settings);
            $scraper_service->run();
            Log::info('Run Scraper by id (' . $scraper_id . ') - ' . date("Y-m-d H:i:s") );
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
