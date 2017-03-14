<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('tipo', [1, 2]); //// 1 => fisica, 2 => jurídica
            $table->string('Nome');
            $table->integer('documento');
            $table->string('endereco');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('UF');
            $table->integer('CEP');
            $table->string('senha', 50);
            $table->string('responsável');
            $table->integer('fone');
            $table->integer('celular');
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
        Schema::dropIfExists('clientes');
    }
}
