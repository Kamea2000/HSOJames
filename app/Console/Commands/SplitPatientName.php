<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Patient;

class SplitPatientName extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'patients:split-names'; // Change the command name here if needed
    protected $description = 'Splits the name column into first_name and last_name';
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $patients = Patient::all();

    foreach ($patients as $patient) {
        $nameParts = explode(' ', $patient->name, 2); // Split into first and last name
        $firstName = $nameParts[0];
        $lastName = $nameParts[1] ?? ''; // Handle case when there's no last name

        $patient->update([
            'first_name' => $firstName,
            'last_name' => $lastName,
        ]);
    }

    $this->info('Patient names have been split.');
    }
}
