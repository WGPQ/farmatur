<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrecuenciaBusquedadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frecuencia_busquedad', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idfarmacia')->unsigned()->nullable();
            $table->integer('numbusquedad');
            $table->timestamps();
            $table->foreign('idfarmacia')->references('id')->on('farmacias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('frecuencia_busquedad');
    }
}
