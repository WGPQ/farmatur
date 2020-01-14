<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farmacias extends Model
{
    protected $fillable=['id_division', 'nomfarmacia', 'telefono','direccion', 'longitud', 'latitud', 'jerarquia'];

    public function Ciudad(){
        
        return $this->belongsTo('App\Divpolitica','id_division');

    }
}
