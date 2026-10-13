<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique()->index();
            $table->string('title');
            $table->integer('lessons_number')->unsigned();
            $table->integer('topics_number')->unsigned();
            $table->string('intro_url');
            $table->string('image_url');
            $table->string('short_description');
            $table->string('levels');
            $table->string('include');
            $table->string('long_description');
            $table->string('class_color');
            $table->integer('category_id')->unsigned()->nullable()->index();
            $table->integer('status')->unsigned();
            $table->integer('platform_status')->unsigned();
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
        Schema::dropIfExists('courses');
    }
}
