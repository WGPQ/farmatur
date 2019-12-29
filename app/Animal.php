<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $table='animal';

    protected $fillable=['nombre'];
}
