<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Divpolitica extends Model
{
    protected $fillable=['parent_id','nomdivision','nivel'];

    public function Parent(){
        
        return $this->belongsTo('App\Divpolitica','parent_id');

    }
}
