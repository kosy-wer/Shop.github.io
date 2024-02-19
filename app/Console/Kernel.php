<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        // Commands\Inspire::class,
        \App\Console\Commands\ClearExpiredTokens::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // Your other scheduled tasks...

        // Clear expired tokens hourly
        $schedule->command('clear:expired-tokens')->hourly();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

