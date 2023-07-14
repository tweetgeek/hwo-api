<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserVerificationCode;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class UserVerificationCodeFactory extends Factory
{
    protected $model = UserVerificationCode::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'code' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
