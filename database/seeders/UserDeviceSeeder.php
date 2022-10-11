<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserDevice;
use Illuminate\Database\Seeder;

class UserDeviceSeeder extends Seeder
{
    public function run()
    {
        User::all()->each(function (User $user) {
            UserDevice::factory()->state(fn () => ['user_id' => $user->id])->create();
        });
    }
}
