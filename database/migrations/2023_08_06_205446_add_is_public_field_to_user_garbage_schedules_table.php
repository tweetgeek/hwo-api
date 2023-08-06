<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('user_garbage_schedules', function (Blueprint $table) {
            $table->string('place_id')->after('code');
            $table->boolean('is_public')->default(false)->after('place_id');
        });
    }

    public function down(): void
    {
        Schema::table('user_garbage_schedules', function (Blueprint $table) {
            $table->dropColumn('place_id');
            $table->dropColumn('is_public');
        });
    }
};
