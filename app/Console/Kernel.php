<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Task;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\TaskReminder::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            Task::where('user_id', 2)
                ->get()
                ->each
                ->delete();
        })->hourly();
        // $schedule->command('task:reminder')->everyMinute();
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
