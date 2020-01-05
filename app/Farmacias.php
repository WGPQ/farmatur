<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farmacias extends Model
{
    protected $fillable=['parent_id','id_division', 'nomfarmacia', 'telefono','direccion', 'longitud', 'latitud', 'jerarquia'];

}
