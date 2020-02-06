<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\User;
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
            $table->string('image',100);
            $table->string('nombre',100);
            $table->string('email')->unique();
            $table->string('cedula',15);
            $table->string('telefono',15);
            $table->string('genero',2);
            $table->string('password');
            $table->integer('rol')->unsigned()->nullable();
            $table->boolean('activo');  
            $table->timestamp('verificar email')->nullable();        
            $table->rememberToken();
            $table->timestamps(); 
            $table->foreign('rol')->references('id')->on('tipos_usuarios');
        });

        $user = new User;
        $user->image='1082468439.png';
        $user->nombre = 'FARMATURN';
        $user->cedula='1004088878';
        $user->email = 'farmaturnfar@gmail.com';
        $user->telefono='0960451658';
        $user->genero='M';
        $user->password = Hash::make('farmaturn');
        $user->rol=1;
        $user->activo=1;
        $user->save();
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
