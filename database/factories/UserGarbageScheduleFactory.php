<?php

namespace Database\Factories;

use App\Models\UserGarbageCollection;
use App\Models\UserGarbageSchedule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UserGarbageSchedule>
 */
class UserGarbageScheduleFactory extends Factory
{
    protected $model = UserGarbageSchedule::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'code' => $this->faker->uuid(),
        ];
    }

    public function withCollections(int $count = 10)
    {
        return $this->has(UserGarbageCollection::factory()->count($count));
    }
}
