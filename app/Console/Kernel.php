<?php

namespace App\Console;

use App\Models\Post;
use App\Models\Scraper;
use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();

        // Check for waiting schedulers every 5 seconds.
        $scrapers = Scraper::where('status', 'ready')->get();

        if (count($scrapers) > 0) {
            foreach($scrapers as $scraper) {
                //Execute commands to execute scraper.
                $out->writeln('Schedule Scraper - ' . $scraper->id . ' (' . date('Y-m-d H:i:s') . ')' );
                $schedule->command('scrape ' . $scraper->id)->runInBackground();
            }
        } else {
            $out->writeln('No scrapers waiting for run. (' . date('Y-m-d H:i:s') . ')' );
        }

        $schedule->call(function () {
            $posts = Post::where('status', 'pre-published')
                ->where('post_date', '=', date('Y-m-d', time()))
                ->get();

            foreach($posts as $post){
                $post->status = 'published';
                $post->created_at = now();
                $post->save();

                $user = User::find($post->user_id);
                $user->followersBroadcast($user->name, 'Added a new post: '.$post->title, '/post/'.$post->slug, $post->id);
            }
        })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
