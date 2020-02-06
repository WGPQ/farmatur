<?php

namespace App\Http\Controllers;

use App\User;
use App\Tipos_usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Mail;
use Session;
use DataTables;
use Validator;

class UsuarioController extends Controller
{
    
    public function __construct()
     {
         $this->middleware('auth');
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tusuarios = Tipos_usuario::all();
        if($request->ajax())
        {
            $data = User::latest()->get(); 
            return DataTables::of($data)
            ->addColumn('rusuario',function($data){
                return $data->tipos_usuario['nombre'];
            }) ->addColumn('active', function($data){
                if($data->activo==1){
                    $button = '';
                    $button .= '<button type="button" name="estado" id="'.$data->id.'" class="acti btn btn-success btn-sm">Activo</button>';
                }else{
                    $button = '';
                $button .= '<button type="button" name="estado" id="'.$data->id.'" class="inacti btn btn-danger btn-sm">Inactivo</button>';
                }
                
                return $button; })
            
            ->addColumn('action', function($data){
                $button = '';
                $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></button>';
                return $button; })->rawColumns(['action','active']) ->make(true);
                    
        }

        return view('usuarios.index',compact('tusuarios'));
        
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
            'image'         =>  'required|image|max:2048',
            'nombre'    =>  'required',
            'email'     =>  'required',
            'cedula'     =>  'required',
            'telefono'     =>  'required',
            'genero'     =>  'required',
            'rol'     =>  'required'
        );
    
        $error = Validator::make($request->all(), $rules);
    
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

   $to_name='William Puma';
    $to_email=$request->email;
    $pas=substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
    $data= array('name'=> "Este es tu contraseña: $pas" ,'body'=>"Test");
    Mail::send('email',$data,function($message) use ($to_name,$to_email){
        $message->subject('BIENVENIDO A FARMATURN');
        $message->to($to_email);
    });
    $image = $request->file('image');
    $new_name = rand() . '.' . $image->getClientOriginalExtension();
    $image->move(public_path('images'), $new_name);
        $form_data = array(
            'email'         =>  $request->email,
            'rol'     =>  $request->rol,
            'password' => Hash::make($pas),
            'activo'     =>  0,
            'image'        =>  $new_name,
            'nombre'        =>  $request->nombre,
            'cedula'         =>  $request->cedula,
            'telefono'     =>  $request->telefono,
            'genero'     =>  $request->genero
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
    public function update(Request $request)
    {
        $image_name = $request->hidden_image;
        $image = $request->file('image');
        if($image != '')
        {
        $rules = array(
            'email'     =>  'required',
//            'password'     =>  'required',
            'rol'     =>  'required',
            'activo'     =>  'required',
            'image'         =>  'required|image|max:2048',
            'nombre'    =>  'required',
            'cedula'     =>  'required',
            'telefono'     =>  'required',
            'genero'     =>  'required'
        );
    
        $error = Validator::make($request->all(), $rules);
    
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $image_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $image_name);
}else{

    $rules = array(
        'email'     =>  'required',
//            'password'     =>  'required',
        'rol'     =>  'required',
        'activo'     =>  'required',
        'nombre'    =>  'required',
        'cedula'     =>  'required',
        'telefono'     =>  'required',
        'genero'     =>  'required'
    );

    $error = Validator::make($request->all(), $rules);

    if($error->fails())
    {
        return response()->json(['errors' => $error->errors()->all()]);
    }

}
      
        $form_data = array(
            'email'         =>  $request->email,
  //          'password'     =>  Hash::make($request->password),
            'rol'     =>  $request->rol,
            'activo'     =>  $request->activo,
            'image'            =>   $image_name,
            'nombre'        =>  $request->nombre,
            'cedula'         =>  $request->cedula,
            'telefono'     =>  $request->telefono,
            'genero'     =>  $request->genero
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
    public function activar($id)
    {
        $form_data = array(
            'activo'     =>  1);
                User::whereId($id)->update($form_data);
    }
    public function desactivar($id)
    {
        $form_data = array(
        'activo'     =>  0);
            User::whereId($id)->update($form_data);
    }

}