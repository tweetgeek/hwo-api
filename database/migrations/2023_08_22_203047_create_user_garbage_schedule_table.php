<?php

use App\Enums\UserScheduleRole;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('user_garbage_schedule', static function (Blueprint $table) {
            $table->foreignId('user_id');
            $table->foreignId('garbage_schedule_id');
            $table->string('role')->default(UserScheduleRole::VIEWER->value);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_garbage_schedule');
    }
};
