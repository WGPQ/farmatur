<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona2 extends Model
{
    protected $table='personas';
    protected $fillable=['nombre','cedula'];
}
