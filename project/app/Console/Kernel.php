<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
            $schedule->job(new \App\Jobs\GenerateDailyStaffAvailabilities())->dailyAt('00:10');
            $schedule->job(new \App\Jobs\UpdateStaffAvailabilities())->dailyAt('00:15');
    }
    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}