<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('garbage_collections', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable(false);
            $table->foreignId('garbage_schedule_id')->constrained();
            $table->foreignId('garbage_type_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('garbage_collections');
    }
};
