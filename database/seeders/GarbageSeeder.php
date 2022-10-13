<?php

namespace Database\Seeders;

use App\Models\GarbageCollection;
use App\Models\GarbageSchedule;
use App\Models\GarbageType;
use App\Models\User;
use App\Models\UserGarbageSchedule;
use Illuminate\Database\Seeder;

class GarbageSeeder extends Seeder
{
    public function run(): void
    {
        $schedule = GarbageSchedule::first();
        User::all()->each(function (User $user) use ($schedule) {
            UserGarbageSchedule::factory()->create(['user_id' => $user->id, 'garbage_schedule_id' => $schedule->id]);
            GarbageType::all()->each(function (GarbageType $type) use ($schedule) {
                GarbageCollection::factory()
                    ->state(fn () => ['garbage_type_id' => $type->id, 'garbage_schedule_id' => $schedule->id])
                    ->count(5)
                    ->create();
            });
        });
    }
}
