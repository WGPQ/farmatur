<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Persona;
class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image');
            $table->string('nombre',100);
            $table->string('email')->unique();
            $table->string('cedula',15);
            $table->string('telefono',15);
            $table->string('genero',2);
            $table->timestamps();
        });
        
        $persona = new Persona;
        $persona->image='977404050.png';
        $persona->nombre = 'William Puma';
        $persona->email='farmaturnfar@gmail.com';
        $persona->cedula='1004096572';
        $persona->telefono='0997702533';
        $persona->genero='M';
        $persona->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
