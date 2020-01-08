<?php

namespace App\Http\Controllers;

use App\User;
use App\Persona;
use App\Tipos_usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use DataTables;
use Validator;

class UsuarioController extends Controller
{



    
    /*public function __construct()
     {
         $this->middleware('auth');
     }*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $personas = Persona::all();
        $tusuarios = Tipos_usuario::all();
        if($request->ajax())
        {
            $data = User::latest()->get(); 
            
            return DataTables::of($data)->addColumn('nombre',function($data){
                return $data->persona['nombre'];
            }) 

            ->addColumn('rusuario',function($data){
                return $data->tipos_usuario['nombre'];
            }) 
            ->addColumn('action', function($data){
                        
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit2</button>';
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button; })->rawColumns(['action']) ->make(true);
                    
        }

        return view('usuarios.index',compact('personas','tusuarios'));
        
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
        $rules = array(
            'idpersona'    =>  'required',
            'email'     =>  'required',
            'password'     =>  'required',
            'rol'     =>  'required',
            'activo'     =>  'required'
        );
    
        $error = Validator::make($request->all(), $rules);
    
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        
    if(isset($request['activo']) and $request['activo']=='on'){
        $uactivo=1;
    }else{
        $uactivo=0; 
    }
        $form_data = array(
            'idpersona'        =>  $request->idpersona,
            'email'         =>  $request->email,
            'password'     =>  Hash::make($request->password),
            'rol'     =>  $request->rol,
            'activo'     =>  $uactivo
        );

        User::create($form_data);
    
        return response()->json(['success' => 'Data Added successfully.']);
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          if(request()->ajax())
        {
            $data = User::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        $rules = array(
            'idpersona'    =>  'required',
            'email'     =>  'required',
            'password'     =>  'required',
            'rol'     =>  'required',
            'activo'     =>  'required'
        );
    
        $error = Validator::make($request->all(), $rules);
    
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
    
      
        $form_data = array(
            'idpersona'        =>  $request->idpersona,
            'email'         =>  $request->email,
            'password'     =>  Hash::make($request->password),
            'rol'     =>  $request->rol,
            'activo'     =>  $request->activo
        );
    
        User::whereId($request->hidden_id)->update($form_data);
    
        return response()->json(['success' => 'Data is successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->delete();
    }
}