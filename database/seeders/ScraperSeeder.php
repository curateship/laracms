<?php

namespace Database\Seeders;

use App\Models\Scraper;
use Illuminate\Database\Seeder;

class ScraperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            [
                'id' => 1,
                'user_id' => 1,
                'default_url' => 'https://thehentaiworld.com/page/154/',
                'direction' => 1,
                'item_url' => '.thumb a',
                'title' => '<title>',
                'image' => 'Full Size',
                'video' => 'type="video/mp4"',
                'artist' => '#tags li a.artist',
                'origins' => '#tags li a.origin',
                'character' => '#tags li a.character',
                'media' => '#tags li a.media',
                'misc' => '#tags li a[class=""]',
                'status' => 'ready'
            ]
        ];

        foreach($seeds as $seed){
            $scraper = new Scraper();
            foreach($seed as $key => $value){
                $scraper->$key = $value;
            }
            $scraper->save();
        }
    }
}
