<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('garbage_schedules', static function (Blueprint $table) {
            $table->id();
            $table->integer('year')->nullable(false);
            $table->string('code')->unique()->nullable(false);
            $table->boolean('is_public')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('garbage_schedules');
    }
};
