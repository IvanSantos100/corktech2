<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsersToCentroDistribuicoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('centrodistribuicao_id')->unsigned()->nullable();
            $table->foreign('centrodistribuicao_id')->references('id')->on('centro_distribuicoes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {

            \Schema::disableForeignKeyConstraints();
            $table->dropColumn('centrodistribuicao_id');
            \Schema::enableForeignKeyConstraints();

        });
    }
}
