<?php

namespace Database\Seeders;

use App\Models\GarbageType;
use Illuminate\Database\Seeder;

class GarbageTypeSeeder extends Seeder
{
    public function run(): void
    {
        collect([
            ['id' => 1, 'name' => 'Zmieszane odpady komunalne', 'icon' => 'recykling', 'color' => '#404040'],
            ['id' => 2, 'name' => 'Papier', 'icon' => 'papier', 'color' => '#0284c7'],
            ['id' => 3, 'name' => 'Metale i tworzywa sztuczne', 'icon' => 'metal', 'color' => '#facc15'],
            ['id' => 4, 'name' => 'Plastiki', 'icon' => 'plastik', 'color' => '#facc15'],
            ['id' => 5, 'name' => 'Szkło', 'icon' => 'szklo', 'color' => '#16a34a'],
            ['id' => 6, 'name' => 'Bioodpady', 'icon' => 'bio', 'color' => '#92400e'],
            ['id' => 7, 'name' => 'Odpady wystawkowe', 'icon' => 'gabaryty', 'color' => '#9ca3af'],
            ['id' => 8, 'name' => 'Elektronika', 'icon' => 'elektronika', 'color' => '#fff'],
            ['id' => 9, 'name' => 'Baterie', 'icon' => 'baterie', 'color' => '#fff'],
            ['id' => 10, 'name' => 'Odpady zielone', 'icon' => 'ogrodowe', 'color' => '#fff'],
        ])->each(function ($item) {
            return GarbageType::factory()->create($item);
        });
    }
}
