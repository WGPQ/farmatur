<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Divpolitica extends Model
{
    protected $table='divpolitica';

    protected $fillable=['idpadre','nomdivision','nivel'];
}
