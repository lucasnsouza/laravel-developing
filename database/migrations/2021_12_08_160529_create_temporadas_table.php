<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemporadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temporadas', function (Blueprint $table) {
            //id de cada temporada
            $table->id('id');

            //número de cada temporada
            $table->integer('numero_temporada');

            //criando uma referência para o id da série
            $table->bigInteger('serie_id')->unsigned();
            //esse serie_id será a chave estrangeira para armazenar o id da tabela series
            //relacionado assim a tabela temporadas com a tabela series
            $table->foreign('serie_id')
            ->references('id')
            ->on('series');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temporadas');
    }
}
