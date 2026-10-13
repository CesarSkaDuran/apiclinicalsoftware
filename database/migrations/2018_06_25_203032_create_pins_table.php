<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique()->index();
            $table->integer('code_type')->unsigned();
            $table->integer('distribuitor')->unsigned();
            $table->integer('posible_activations')->unsigned();
            $table->datetime('buy_date');
            $table->datetime('block_date');
            $table->string('block_reason');
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
        Schema::dropIfExists('pins');
    }
}
