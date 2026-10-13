<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses_progress', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('course_id')->unsigned()->nullable()->index();
            $table->integer('account_id')->unsigned()->nullable()->index();
            $table->integer('progress')->unsigned();
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->integer('certificate_id')->unsigned();
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
        Schema::dropIfExists('courses_progress');
    }
}
