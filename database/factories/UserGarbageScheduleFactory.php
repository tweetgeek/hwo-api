<?php

namespace Database\Factories;

use App\Models\UserGarbageCollection;
use App\Models\UserGarbageSchedule;
use Carbon\Carbon;
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
            'name' => 'Mój harmonogram',
            'code' => $this->faker->uuid(),
        ];
    }

    public function withCollections(int $count = 10)
    {
        return $this->has(UserGarbageCollection::factory()->count($count));
    }
    public function withNextCollections()
    {
        $now = Carbon::now();
        return $this
            ->has(UserGarbageCollection::factory()->state(fn () => ['date' => $now, 'garbage_type_id' => 1]))
            ->has(UserGarbageCollection::factory()->state(fn () => ['date' => $now->clone()->add('1 day'), 'garbage_type_id' => 2]))
            ->has(UserGarbageCollection::factory()->state(fn () => ['date' => $now->clone()->add('2 day'), 'garbage_type_id' => 3]))
            ->has(UserGarbageCollection::factory()->state(fn () => ['date' => $now->clone()->add('3 day'), 'garbage_type_id' => 4]))
        ;
    }
}
