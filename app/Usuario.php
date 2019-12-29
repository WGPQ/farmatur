<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'users';

    protected $fillable = ['nombre','cedula', 'email','genero', 'tipouser',  'password'];
}
