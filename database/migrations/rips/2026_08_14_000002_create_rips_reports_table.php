<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRipsReportsTable extends Migration
{
    public function up()
    {
        Schema::create('rips_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('owner_user_id');
            $table->string('num_documento_id_obligado', 12);
            $table->string('num_nota', 30);
            $table->longText('payload');
            $table->timestamps();
            $table->unique(['num_documento_id_obligado', 'num_nota']);
            $table->index(['owner_user_id', 'created_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('rips_reports');
    }
}
