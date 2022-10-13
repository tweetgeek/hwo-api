<?php

namespace Database\Seeders;

use App\Models\GarbageCollection;
use App\Models\GarbageSchedule;
use App\Models\GarbageType;
use App\Models\User;
use Illuminate\Database\Seeder;

class GarbageCollectionsSeeder extends Seeder
{
    public function run(): void
    {
        User::all()->each(function (User $user) {
            $user->garbageSchedules->each(function (GarbageSchedule $season) use ($user) {
                $user->garbageTypes->each(function (GarbageType $type) use ($user, $season) {
                    GarbageCollection::factory()
                        ->state(fn () => ['user_id' => $user->id, 'garbage_type_id' => $type->id, 'garbage_schedule_id' => $season->id])
                        ->count(5)
                        ->create();
                });
            });
        });
    }
}
