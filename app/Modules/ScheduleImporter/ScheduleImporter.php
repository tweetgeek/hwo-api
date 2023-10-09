<?php

namespace App\Modules\ScheduleImporter;

use App\Modules\ScheduleImporter\Providers\EcoHarmonogramProvider;

class ScheduleImporter
{
    /**
     * @var EcoHarmonogramProvider[]|array
     */
    protected array $providers;

    public function __construct()
    {
        $this->providers = [
            app(EcoHarmonogramProvider::class),
        ];
    }

    public function import(): void
    {
        foreach ($this->providers as $provider) {
            $provider->import();
        }
    }
}
