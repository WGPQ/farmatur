<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['idpersona','email','password','rol','activo'];

    public function persona(){
        return $this->belongsTo('App\Persona','idpersona');
    }

    public function tipos_usuario(){
        return $this->belongsTo('App\Tipos_usuario','rol');
    }
    
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
   // protected $hidden = ['password', 'remember_token'];


}