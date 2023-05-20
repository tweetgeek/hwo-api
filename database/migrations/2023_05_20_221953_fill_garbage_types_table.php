<?php

use App\Models\GarbageType;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    private const TYPES = [
        ['id' => 1, 'name' => 'Zmieszane odpady komunalne', 'icon' => 'recykling', 'color' => '#404040', 'primary' => true],
        ['id' => 2, 'name' => 'Papier', 'icon' => 'papier', 'color' => '#0284c7', 'primary' => true],
        ['id' => 3, 'name' => 'Metale i tworzywa sztuczne', 'icon' => 'metal', 'color' => '#facc15', 'primary' => true],
        ['id' => 4, 'name' => 'Plastiki', 'icon' => 'plastik', 'color' => '#facc15'],
        ['id' => 5, 'name' => 'Szkło', 'icon' => 'szklo', 'color' => '#16a34a', 'primary' => true],
        ['id' => 6, 'name' => 'Bioodpady', 'icon' => 'bio', 'color' => '#92400e', 'primary' => true],
        ['id' => 7, 'name' => 'Odpady wystawkowe', 'icon' => 'gabaryty', 'color' => '#9ca3af'],
        ['id' => 8, 'name' => 'Elektronika', 'icon' => 'elektronika', 'color' => '#000'],
        ['id' => 9, 'name' => 'Baterie', 'icon' => 'baterie', 'color' => '#000'],
        ['id' => 10, 'name' => 'Odpady zielone', 'icon' => 'ogrodowe', 'color' => '#000'],
    ];

    public function up(): void
    {
        collect(self::TYPES)->each(function ($item) {
            return GarbageType::insert([...$item, 'created_at' => now(), 'updated_at' => now()]);
        });
    }

    public function down(): void
    {
        $ids = collect(self::TYPES)->pluck('id')->toArray();
        GarbageType::whereIn('id', $ids)->delete();
    }
};
