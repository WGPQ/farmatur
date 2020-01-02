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
         $data['users'] = Post::orderBy('id','desc')->paginate(8);
   
         return view('usuarios.index',$data);
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
       /* $request->validate([
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
*/
$usuario = new Usuario();
$usuario ->nombre= $request ->input('nombre');
$usuario ->email= $request ->input('email');
$usuario ->password= Hash::make($request ->input('password'));
$usuario ->cedula= $request ->input('cedula');
$usuario ->genero= $request ->input('genero');
$usuario ->tipouser= $request ->input('tipouser');
$usuario->save();

return redirect()->route('usuarios.index')->with('success','Blog created successfully.');


//
$usuarioID = $request->user_id;
$usuario   =   Post::updateOrCreate(['id' => $usuarioID],
            ['title' => $request->title, 'body' => $request->body]);

return Response::json($post);
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
