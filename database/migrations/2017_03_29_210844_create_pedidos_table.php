<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('tipo', [1, 2, 3]);  //1 = entrada, 2 = movimentação e 3 = saída
            $table->enum('status', [1, 2]);
            $table->float('valor_base');
            $table->float('desconto');
            $table->enum('forma_pagamento', [1, 2]);
            $table->text('obs');

            $table->integer('origem_id')->unsigned()->nullable();
            $table->foreign('origem_id')->references('id')->on('centro_distribuicoes');

            $table->integer('destino_id')->unsigned()->nullable();
            $table->foreign('destino_id')->references('id')->on('centro_distribuicoes');

            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes');

            $table->date('date_confirmacao');
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
        Schema::dropIfExists('pedidos');
    }
}