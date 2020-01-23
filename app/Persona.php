<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable = ['image', 'nombre','email', 'cedula', 'telefono','genero'];
    
}
