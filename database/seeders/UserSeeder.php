<?php

namespace Database\Seeders;

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
                ->create(['name' => 'John Doe', 'email' => 'user@testuser.pl', 'password' => Hash::make('fiat126IsAwes0m3')]);
        }
    }
}
