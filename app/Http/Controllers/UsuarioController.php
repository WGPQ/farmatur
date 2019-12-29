<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
    public function index()
    {
        $usuarios=Usuario::latest()->paginate(5);
        return view('usuarios.index',compact('usuarios'))->with('i',(request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>'required',
            'cedula'=>'required',
            'email'=>'required',
            'password'=>'required',
            'genero'=>'required',
            //'activo'=>'required',
            'tipouser'=>'required',
            
        ]);

       // User::create($request->all());
         Usuario::create([
            'nombre' => $request['nombre'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'cedula' =>$request['cedula'],
            'genero' =>$request['genero'],
            'tipouser' =>$request['tipouser'],
                ]);

       return redirect()->route('usuarios.index')->with('success','Blog created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        return view('usuarios.show',compact('usuario'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        return view('usuarios.edit',compact('usuario'));
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
        $request->validate([
            'nombre'=>'required',
            'cedula'=>'required',
            'email'=>'required',
            'password'=>'required',
            'genero'=>'required',
            //'activo'=>'required',
            'tipouser'=>'required',   
        ]);

        $usuario->update($request->all());
        return redirect()->route('usuarios.index')->with('success','Blog update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success','Blog delete successfully.');
    }
}
