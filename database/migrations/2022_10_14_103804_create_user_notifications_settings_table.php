<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up()
    {
        Schema::create('user_notification_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->boolean('send_to_email')->default(true);
            $table->boolean('send_to_app')->default(true);
            $table->unsignedInteger('notify_day')->default(1);
            $table->string('at_time')->default('19:00');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_notification_settings');
    }
};
