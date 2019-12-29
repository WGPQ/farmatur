<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farmacia extends Model
{
    protected $table='farmacia';

    protected $fillable=['id_division', 'nomfarmacias', 'telefono','direccion', 'longitud', 'latitud', 'jerarqua'];
}
