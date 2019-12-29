<?php

namespace App\Http\Controllers;
use App\Persona;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use App\http\Requests;
use Illuminate\Http\Request;
class PersonaController extends Controller
{
  public function index(){
    $persona = Persona::paginate(4);
    return view('persona.index',compact('persona'));
  }

  public function addPersona(Request $request){
    $rules = array(
      'nombre' => 'required',
      'cedula' => 'required',
    );
  $validator = Validator::make ( Input::all(), $rules);
  if ($validator->fails())
  return Response::json(array('errors'=> $validator->getMessageBag()->toarray()));

  else {
    $persona = new Persona;
    $persona->nombre = $request->nombre;
    $persona->cedula = $request->cedula;
    $persona->save();
    return response()->json($persona);
  }
}

public function editPersona(request $request){
$persona = Persona::find ($request->id);
$persona->nombre = $request->nombre;
$persona->cedula = $request->cedula;
$persona->save();
return response()->json($persona);
}

public function deletePersona(request $request){
$persona = Persona::find ($request->id)->delete();
return response()->json();
}
}