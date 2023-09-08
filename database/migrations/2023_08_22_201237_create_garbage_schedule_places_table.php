<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('garbage_schedule_place', static function (Blueprint $table) {
            $table->foreignId('garbage_schedule_id');
            $table->foreignId('place_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('garbage_schedule_place');
    }
};
