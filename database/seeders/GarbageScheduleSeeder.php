<?php

namespace Database\Seeders;

use App\Models\GarbageSchedule;
use App\Models\User;
use Illuminate\Database\Seeder;

class GarbageScheduleSeeder extends Seeder
{
    public function run(): void
    {
        User::all()->each(function (User $user) {
            GarbageSchedule::factory()->state(fn () => ['user_id' => $user->id])->create();
        });
    }
}
