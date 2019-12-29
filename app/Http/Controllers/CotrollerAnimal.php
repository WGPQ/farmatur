<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use\App\Animal;
use \App\Http\Requests;
class CotrollerAnimal extends Controller
{
    
 public function vista(){
return view('agregar');
}

    public function create(Request $request){
        $animal=new Animal();
       $request->validate(['nombre']);
      //  $animal->$nombre=$request->nombre;
        $request->save();
        return redirect('/create');
    }
}