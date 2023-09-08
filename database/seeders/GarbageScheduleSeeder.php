<?php

namespace Database\Seeders;

use App\Models\GarbageSchedule;
use Illuminate\Database\Seeder;

class GarbageScheduleSeeder extends Seeder
{
    public function run(): void
    {
        GarbageSchedule::factory()->count(3)->withCollections()->withNextCollections()->create();
    }
}
