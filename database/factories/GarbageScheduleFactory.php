<?php

namespace Database\Factories;

use App\Models\GarbageCollection;
use App\Models\GarbageSchedule;
use Carbon\Carbon;
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
            GarbageSchedule::FIELD_YEAR => $this->faker->date('Y'),
            GarbageSchedule::FIELD_CODE => $this->faker->uuid(),
            GarbageSchedule::FIELD_IS_PUBLIC => $this->faker->boolean(),
        ];
    }

    public function withCollections(int $count = 10): GarbageScheduleFactory
    {
        return $this->has(GarbageCollection::factory()->count($count));
    }
    public function withNextCollections(): GarbageScheduleFactory
    {
        $now = Carbon::now();
        return $this
            ->has(GarbageCollection::factory()->state(fn () => ['date' => $now, 'garbage_type_id' => 1]))
            ->has(GarbageCollection::factory()->state(fn () => ['date' => $now->clone()->add('1 day'), 'garbage_type_id' => 2]))
            ->has(GarbageCollection::factory()->state(fn () => ['date' => $now->clone()->add('2 day'), 'garbage_type_id' => 3]))
            ->has(GarbageCollection::factory()->state(fn () => ['date' => $now->clone()->add('3 day'), 'garbage_type_id' => 4]))
        ;
    }
}
