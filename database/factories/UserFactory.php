<?php

namespace Database\Factories;

use App\Enums\UserRole;
use App\Models\User;
use App\Models\UserNotificationSetting;
use App\Models\UserOnboarding;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the user should have a personal team.
     */
//    public function withPersonalTeam(callable $callback = null): static
//    {
//        if (! Features::hasTeamFeatures()) {
//            return $this->state([]);
//        }
//
//        return $this->has(
//            Team::factory()
//                ->state(fn (array $attributes, User $user) => [
//                    'name' => $user->name.'\'s Team',
//                    'user_id' => $user->id,
//                    'personal_team' => true,
//                ])
//                ->when(is_callable($callback), $callback),
//            'ownedTeams'
//        );
//    }

    public function withWelcomeOnboarding(): UserFactory
    {
        return $this
            ->has(UserOnboarding::factory()->state(fn () => [
                'name' => 'welcome',
            ]))
            ->has(UserNotificationSetting::factory());
    }

    public function asUser(): UserFactory
    {
        return $this->afterMaking(function (User $user) {
            $user->assignRole(UserRole::USER->value);
        });
    }

    public function asSuperAdmin(): UserFactory
    {
        return $this->afterMaking(function (User $user) {
            $user->assignRole(UserRole::SUPER_ADMIN->value);
        });
    }
}
