<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics_progress', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lesson_progress_id')->unsigned()->nullable()->index();
            $table->integer('topic_id')->unsigned()->nullable()->index();
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->integer('status')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topics_progress');
    }
}
