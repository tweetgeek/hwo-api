<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        if (config('app.env') === 'local') {
            User::factory()
                ->withWelcomeOnboarding()
                ->withScheduleWithCollections()
                ->afterMaking(function (User $user) {
                    $user->assignRole(UserRole::SUPER_ADMIN->value);
                })
                ->create(['name' => 'John Doe', 'email' => 'user@tweetgeek.pl', 'password' => Hash::make('password')]);
        }
    }
}
