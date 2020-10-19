<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Twitter\SyncFollowerIds::class,
        Commands\Twitter\SyncAutoDMs::class,
        Commands\Twitter\SyncFollowingIds::class,
        Commands\Twitter\SyncTweets::class,
        Commands\Twitter\SyncRetweets::class,
        Commands\Twitter\SyncLikes::class,
        Commands\Twitter\SyncEmails::class,
        Commands\Facebook\SyncPosts::class,
        Commands\RunScheduledPosts::class,
        Commands\RunScheduledEmails::class,
        Commands\SyncArticles::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('sync:follower.ids')
            ->everyThirtyMinutes();

        $schedule->command('sync:autodm.ids')
            ->hourlyAt(10);

        $schedule->command('sync:autodm.ids')
            ->hourlyAt(40);

        $schedule->command('sync:following.ids')
            ->everyThirtyMinutes();

        $schedule->command('sync:tweets')
            ->everyThirtyMinutes();

        $schedule->command('sync:retweets')
            ->everyThirtyMinutes();

        $schedule->command('sync:likes')
            ->everyThirtyMinutes();

        $schedule->command('run:scheduled')
            ->everyMinute();

        $schedule->command('run:emails')
            ->everyMinute();

        $schedule->command('sync:articles')
            ->twiceDaily(1, 13);

        $schedule->command('sync:emails')
            ->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
