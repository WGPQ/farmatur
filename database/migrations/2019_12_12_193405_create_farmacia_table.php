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
        Schema::create('farmacia', function (Blueprint $table) {
            $table->increments('id');
           $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('id_division')->unsigned()->nullable();
            $table->string('nomfarmacias',100);
            $table->string('telefono',20);
            $table->string('direccion',100);
            $table->string('longitud',100);
            $table->string('latitud',100);
           // $table->integer('activo');
            $table->string('jerarqua',100);
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('farmacia');
            $table->foreign('id_division')->references('id')->on('divpolitica');
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
