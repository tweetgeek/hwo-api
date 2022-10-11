<?php

namespace Database\Factories;

use App\Models\UserDevice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UserDevice>
 */
class UserDeviceFactory extends Factory
{
    protected $model = UserDevice::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $system = fake()->randomElement(['android', 'ios']);

        return [
            'device_unique_id' => fake()->uuid(),
            'system_name' => $system,
            'system_version' => $system === 'ios' ? '11.0' : '7.1.1',
            'device_id' => $system === 'ios' ? 'iPhone7,2' : 'goldfish',
            'device_token' => $system === 'ios' ? fake()->uuid() : null,
            'last_seen' => fake()->dateTime(),
        ];
    }

    public function unseen(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'last_seen' => null,
            ];
        });
    }
}
