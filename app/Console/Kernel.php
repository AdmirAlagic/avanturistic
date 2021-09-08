<?php

namespace App\Console;

use App\Console\Commands\FixImages;
use App\Console\Commands\UpdateSlugs;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\DeleteMessages;
use  App\Console\Commands\FillCategories;
use  App\Console\Commands\ResizeImgs;
use App\Console\Commands\HighlightTimelapse;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        DeleteMessages::class,
        FixImages::class,
        UpdateSlugs::class,
        FillCategories::class,
        ResizeImgs::class,
        HighlightTimelapse::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
         $schedule->command('messages:delete_old')
                  ->daily();
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
