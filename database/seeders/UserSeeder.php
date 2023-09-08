<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()
            ->withWelcomeOnboarding()
            ->asUser()
            ->create(['name' => 'User Testowy', 'email' => 'tester@hwoapp.pl', 'password' => Hash::make('cny!jrk9EBV@tnb@hky')]);

        if (config('app.env') === 'local') {
            User::factory()
                ->withWelcomeOnboarding()
                ->asUser()
                ->create(['name' => 'John Doe', 'email' => 'user@tweetgeek.pl', 'password' => Hash::make('password')]);

            User::factory()
                ->asUser()
                ->create(['name' => 'John Bandit', 'email' => 'user2@tweetgeek.pl', 'password' => Hash::make('password')]);

            User::factory()
                ->withWelcomeOnboarding()
                ->asSuperAdmin()
                ->create(['name' => 'John Admin', 'email' => 'user3@tweetgeek.pl', 'password' => Hash::make('password')]);
        }
    }
}
