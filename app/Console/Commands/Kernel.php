<?php
// app/Console/Kernel.php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\SplitPatientName;  // Add the command class import here

class Kernel extends ConsoleKernel
{
    protected $commands = [
        SplitPatientName::class,  // Register the command here
    ];

    protected function schedule(Schedule $schedule)
    {
        // Schedule commands if needed
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}
