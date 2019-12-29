<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdiministradorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adiministrador', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idpersona')->unsigned()->nullable();
            $table->string('password',50);
            $table->integer('rol')->unsigned()->nullable();
            $table->boolean('activo');
            $table->timestamps();
            $table->foreign('idpersona')->references('id')->on('personas');
            $table->foreign('rol')->references('id')->on('tipos_usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adiministrador');
    }
}
