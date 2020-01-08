<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idpersona')->unsigned()->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('rol')->unsigned()->nullable();
            $table->boolean('activo');  
            $table->timestamp('verificar email')->nullable();        
            $table->rememberToken();
            $table->timestamps(); 
            $table->foreign('idpersona')->references('id')->on('personas');
            $table->foreign('rol')->references('id')->on('tipos_usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
