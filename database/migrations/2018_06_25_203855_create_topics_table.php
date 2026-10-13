<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lesson_id')->unsinged()->nullable()->index();
            $table->integer('type')->unsinged();
            $table->string('name');
            $table->integer('topic_number');
            $table->string('topic_url');
            $table->string('material_url');
            $table->string('previsualization_url');
            $table->string('description');
            $table->string('html_video');
            $table->string('video_url');
            $table->string('cuts');
            $table->string('messages');
            $table->integer('status');
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
        Schema::dropIfExists('topics');
    }
}
