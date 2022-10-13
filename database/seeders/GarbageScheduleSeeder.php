<?php

namespace Database\Seeders;

use App\Models\GarbageSchedule;
use Illuminate\Database\Seeder;

class GarbageScheduleSeeder extends Seeder
{
    public function run(): void
    {
        GarbageSchedule::factory()->create(['name' => 'Współdzielony harmonogram']);
    }
}
