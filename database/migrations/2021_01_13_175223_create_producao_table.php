<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProducaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producao', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('foto_producao');
            $table->string('lote');
            $table->string('nome_producao');
            $table->string('nome_produtor');
            $table->string('data_producao');
            $table->string('og_producao');
            $table->string('acompanhamento');
            $table->string('maturacao');
            $table->string('data_envase');
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
        Schema::dropIfExists('producao');
    }
}
