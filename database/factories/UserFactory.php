<?php

namespace Database\Factories;

use App\Models\UserGarbageSchedule;
use App\Models\UserNotificationSetting;
use App\Models\UserOnboarding;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'verified_at' => null,
        ]);
    }

    public function withWelcomeOnboarding()
    {
        return $this
            ->has(UserOnboarding::factory()->state(fn () => [
                'name' => 'welcome',
            ]))
            ->has(UserNotificationSetting::factory());
    }

    public function withSchedule()
    {
        return $this->has(UserGarbageSchedule::factory());
    }

    public function withScheduleWithCollections()
    {
        return $this->has(UserGarbageSchedule::factory()->withCollections()->withNextCollections());
    }
}
