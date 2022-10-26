<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserNotificationSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        if (config('app.env') === 'local') {
            User::factory()
                ->has(UserNotificationSetting::factory())
                ->create(['name' => 'John Doe', 'email' => 'user@testuser.pl', 'password' => Hash::make('fiat126IsAwes0m3')]);
        }
    }
}
