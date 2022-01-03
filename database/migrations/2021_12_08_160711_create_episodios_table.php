<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEpisodiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodios', function (Blueprint $table) {
            //id de cada episodio
            $table->id('id');

            //número de episodios
            $table->integer('numero_episodio');

            //id para referenciar a temporada a qual pertence
            $table->bigInteger('temporada_id')->unsigned();
            $table->foreign('temporada_id')
                ->references('id')
                ->on('temporadas');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('episodios');
    }
}
