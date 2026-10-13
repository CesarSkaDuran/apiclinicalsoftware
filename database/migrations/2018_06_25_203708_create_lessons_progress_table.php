<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons_progress', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_progress_id')->unsigned()->nullable()->index();
            $table->integer('lesson_id')->unsigned()->nullable()->index();
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->integer('progress')->unsigned();
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
        Schema::dropIfExists('lessons_progress');
    }
}
