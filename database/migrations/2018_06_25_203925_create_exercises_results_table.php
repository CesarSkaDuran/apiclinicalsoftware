<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExercisesResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercises_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('exercise_id')->unsigned()->nullable()->index();
            $table->integer('account_topic_id')->unsigned()->nullable()->index();
            $table->string('user_solution');
            $table->integer('is_correct')->unsigned();
            $table->integer('try_number')->unsigned();
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
        Schema::dropIfExists('exercises_results');
    }
}
