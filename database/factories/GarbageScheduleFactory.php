<?php

namespace Database\Factories;

use App\Models\GarbageSchedule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<GarbageSchedule>
 */
class GarbageScheduleFactory extends Factory
{
    protected $model = GarbageSchedule::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            GarbageSchedule::FIELD_NAME => fake()->unique()->word(),
            GarbageSchedule::FIELD_CODE => fake()->unique()->word(),
        ];
    }
}
