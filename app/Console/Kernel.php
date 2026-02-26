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
        // 🔄 Synchroniser les données Microsoft 365 toutes les 15 minutes
        // pour tous les utilisateurs SSO
        $schedule->command('microsoft:sync')
            ->everyFifteenMinutes()
            ->withoutOverlapping()
            ->onOneServer(); // Important si vous avez plusieurs serveurs

        // Optionnel : log la synchronisation
        $schedule->command('microsoft:sync')
            ->everyFifteenMinutes()
            ->appendOutputTo(storage_path('logs/microsoft-sync.log'));
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
