<?php

use App\Services\ScraperService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use App\Models\Scraper;
use App\Models\ScraperLog;

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
