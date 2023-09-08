<?php

namespace Database\Factories;

use App\Enums\UserScheduleRole;
use App\Models\GarbageSchedule;
use App\Models\User;
use App\Models\UserGarbageSchedule;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class UserGarbageScheduleFactory extends Factory
{
    protected $model = UserGarbageSchedule::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'garbage_schedule_id' => GarbageSchedule::factory(),
            'role' => UserScheduleRole::VIEWER->value,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
