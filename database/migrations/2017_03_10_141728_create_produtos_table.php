<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('produtos', function(Blueprint $table) {
            $table->increments('id');
            $table->string('descricao',50);
            $table->float('preco');

            $table->integer('estampa_id')->unsigned();
            $table->foreign('estampa_id')->references('id')->on('estampas');

            $table->integer('classe_id')->unsigned();
            $table->foreign('classe_id')->references('id')->on('classes');

            $table->integer('tipoproduto_id')->unsigned();
            $table->foreign('tipoproduto_id')->references('id')->on('tipo_produtos');

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
		Schema::drop('produtos');
	}

}
