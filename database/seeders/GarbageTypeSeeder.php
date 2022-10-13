<?php

namespace Database\Seeders;

use App\Models\GarbageType;
use Illuminate\Database\Seeder;

class GarbageTypeSeeder extends Seeder
{
    public function run(): void
    {
        collect([
            ['name' => 'Zmieszane odpady komunalne', 'icon' => 'trash-o', 'color' => '#404040'],
            ['name' => 'Papier', 'icon' => 'newspaper-o', 'color' => '#0284c7'],
            ['name' => 'Metale i tworzywa sztuczne', 'icon' => 'rocket', 'color' => '#facc15'],
            ['name' => 'Szkło', 'icon' => 'wine-glass', 'color' => '#16a34a'],
            ['name' => 'Bioodpady', 'icon' => 'biohazard', 'color' => '#92400e'],
            ['name' => 'Odpady wystawkowe', 'icon' => 'tv', 'color' => '#9ca3af'],
        ])->each(function ($item) {
            return GarbageType::factory()->create($item);
        });

//        User::all()->each(function (User $user) {
//            GarbageType::factory()->state(fn () => ['user_id' => $user->id])->create(['name' => 'Type of user #' . $user->id]);
//        });
    }
}
