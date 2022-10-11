<?php

namespace Database\Factories;

use App\Models\GarbageCollection;
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
    public function definition()
    {
        return [
            //            'name' => fake()->name(),
            'date' => fake()->dateTimeBetween('01-01-2022', '31-12-2022')->format('Y-m-d'),
        ];
    }
}
