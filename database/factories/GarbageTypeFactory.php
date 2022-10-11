<?php

namespace Database\Factories;

use App\Models\GarbageType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<GarbageType>
 */
class GarbageTypeFactory extends Factory
{
    protected $model = GarbageType::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'user_id' => null,
        ];
    }
}
