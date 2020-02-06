<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmaciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmacias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_division')->unsigned()->nullable();
            $table->string('nomfarmacia',100);
            $table->string('telefono',20);
            $table->string('direccion',100);
            $table->string('latitude',100);
            $table->string('longitude',100);
           // $table->integer('activo');
            $table->string('jerarquia',100);
            $table->timestamps();
            $table->foreign('id_division')->references('id')->on('divpoliticas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farmacia');
    }
}
