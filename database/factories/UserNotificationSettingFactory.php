<?php

namespace Database\Factories;

use App\Models\UserNotificationSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<UserNotificationSetting>
 */
class UserNotificationSettingFactory extends Factory
{
    protected $model = UserNotificationSetting::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'send_to_email' => $this->faker->boolean,
            'send_to_app' => $this->faker->boolean,
            'notify_day' => $this->faker->numberBetween(0, 2),
            'at_time' => '19:00',
        ];
    }
}
