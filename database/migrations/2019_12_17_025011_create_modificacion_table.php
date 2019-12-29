<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModificacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modificacion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idadmin')->unsigned()->nullable();
            $table->integer('idfarmacia')->unsigned()->nullable();
            $table->string('valor_viejo',100);
            $table->string('valor_nuevo',100);
            $table->date('fecha');
            $table->timestamps();
            $table->foreign('idadmin')->references('id')->on('adiministrador');
            $table->foreign('idfarmacia')->references('id')->on('farmacia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modificacion');
    }
}
