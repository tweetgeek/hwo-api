<?php

namespace App\Console\Commands;

use App\Modules\ScheduleImporter\ScheduleImporter;
use Illuminate\Console\Command;

class SchedulesImportCommand extends Command
{
    protected $signature = 'schedules:import';

    protected $description = 'Command description';

    public function __construct(protected readonly ScheduleImporter $scheduleImporter)
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $this->scheduleImporter->import();
    }
}
