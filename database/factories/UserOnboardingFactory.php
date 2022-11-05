<?php

namespace Database\Factories;

use App\Models\UserOnboarding;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UserOnboarding>
 */
class UserOnboardingFactory extends Factory
{
    protected $model = UserOnboarding::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'value' => null,
        ];
    }
}
