<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRipsProviderConfigsTable extends Migration
{
    public function up()
    {
        Schema::create('rips_provider_configs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('owner_user_id')->unique();
            $table->string('num_documento_id_obligado', 12)->unique();
            $table->string('cod_prestador', 12)->nullable();
            $table->unsignedBigInteger('next_num_nota')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rips_provider_configs');
    }
}
