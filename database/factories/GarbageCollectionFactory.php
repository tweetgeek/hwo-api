<?php

namespace Database\Factories;

use App\Models\GarbageCollection;
use App\Models\GarbageType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<GarbageCollection>
 */
class GarbageCollectionFactory extends Factory
{
    protected $model = GarbageCollection::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = GarbageType::get();

        return [
            'garbage_type_id' => $types->random(),
            'date' => fake()->dateTimeBetween('-1 month', '+4 months')->format('Y-m-d'),
        ];
    }
}
