<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 40);
            $table->string('channel', 20);
            $table->unsignedInteger('patient_id')->nullable();
            $table->string('reference', 60)->nullable();
            $table->string('recipient')->nullable();
            $table->string('status', 20);
            $table->text('detail')->nullable();
            $table->timestamps();

            $table->index(['type', 'patient_id', 'reference']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification_logs');
    }
}
