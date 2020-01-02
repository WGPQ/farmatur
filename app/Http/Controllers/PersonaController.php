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
  public function index()
    {
      $persona['personas'] = Persona::orderBy('id','asc')->paginate(8);
   
      return view('persona.index',$persona)->with('i',(request()->input('page',1)-1)*5);  

      //$persona=Persona::latest()->paginate(5);
       
    //  return view('personas.index',compact('personas'))->with('i',(request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $personaID = $request->persona_id;
        $persona   =   Persona::updateOrCreate(['id' => $personaID],
                    ['nombre' => $request->nombre, 'cedula' => $request->cedula, 'telefono' => $request->telefono,
                    'email' => $request->email, 'genero' => $request->genero]);
    
        return Response::json($persona);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $where = array('id' => $id);
      $persona  = Persona::where($where)->first();

      return Response::json($persona);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $persona = Persona::where('id',$id)->delete();
   
      return Response::json($persona);
    }
}