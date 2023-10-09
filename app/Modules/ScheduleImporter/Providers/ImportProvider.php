<?php

namespace App\Modules\ScheduleImporter\Providers;

abstract class ImportProvider
{
    public $title = 'title';
    public $description = 'description';

    abstract public function import(): void;
}
