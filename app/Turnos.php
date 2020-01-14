<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turnos extends Model
{
    protected $fillable=['idfarmacia','fecha_inicio','fecha_fin'];
    
    public function Farmacia(){
        
        return $this->belongsTo('App\Farmacias','idfarmacia');

    }
}