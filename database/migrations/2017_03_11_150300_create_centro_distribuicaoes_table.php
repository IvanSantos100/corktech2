<?php

use CorkTech\Models\CentroDistribuicao;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCentroDistribuicaoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centro_distribuicoes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao');
            $table->enum('tipo', array_keys(CentroDistribuicao::TIPO)); // 1 => Nacional , 2 => Distribuidora, 3 => Revenda
            $table->integer('prazo_fabrica');
            $table->integer('prazo_nacional');
            $table->integer('prazo_regional');
            $table->float('valor_base');
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
        Schema::dropIfExists('centro_distribuicoes');
    }
}
