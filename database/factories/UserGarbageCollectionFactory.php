<?php

namespace Database\Factories;

use App\Models\GarbageType;
use App\Models\UserGarbageCollection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UserGarbageCollection>
 */
class UserGarbageCollectionFactory extends Factory
{
    protected $model = UserGarbageCollection::class;

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
