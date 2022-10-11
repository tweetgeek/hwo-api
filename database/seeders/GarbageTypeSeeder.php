<?php

namespace Database\Seeders;

use App\Models\GarbageType;
use App\Models\User;
use Illuminate\Database\Seeder;

class GarbageTypeSeeder extends Seeder
{
    public function run(): void
    {
        collect([
            'Zmieszane odpady komunalne',
            'Papier',
            'Metale i tworzywa sztuczne',
            'Szkło',
            'Bioodpady',
            'Odpady wystawkowe',
        ])->each(function ($name) {
            return GarbageType::factory()->create(['name' => $name]);
        });

        User::all()->each(function (User $user) {
            GarbageType::factory()->state(fn () => ['user_id' => $user->id])->create(['name' => 'Type of user #' . $user->id]);
        });
    }
}
