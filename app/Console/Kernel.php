<?php

namespace App\Console;


use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        \App\Console\Commands\Make\ControllerMakeCustomCommand::class,
        \App\Console\Commands\Make\ServiceMakeCommand::class,
        \App\Console\Commands\Make\ModelMakeCustomCommand::class,
        \App\Console\Commands\Make\RepositoryMakeCommand::class,
        \App\Console\Commands\ModelGeneratorCommand::class,
        \App\Console\Commands\ControllerGeneratorCommand::class,
    ];
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('telescope:prune')->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
