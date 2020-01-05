<?php

namespace App\Http\Controllers;

use App\Persona;
use Illuminate\Http\Request;
use DataTables;
use Validator;
class PersonaController extends Controller
{
  public function index(Request $request)
    {
      if($request->ajax())
      {
          $data = Persona::latest()->get();
          return DataTables::of($data)
                  ->addColumn('action', function($data){
                      $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                      $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                      return $button;
                  })
                  ->rawColumns(['action'])
                  ->make(true);
      }
      return view('persona.index');
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
        'nombre'    =>  'required',
        'cedula'     =>  'required',
        'telefono'     =>  'required',
        'email'     =>  'required',
        'genero'     =>  'required'
    );

    $error = Validator::make($request->all(), $rules);

    if($error->fails())
    {
        return response()->json(['errors' => $error->errors()->all()]);
    }

    $form_data = array(
        'nombre'        =>  $request->nombre,
        'cedula'         =>  $request->cedula,
        'telefono'     =>  $request->telefono,
        'email'     =>  $request->email,
        'genero'     =>  $request->genero
    );

    Persona::create($form_data);

    return response()->json(['success' => 'Data Added successfully.']);
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
      if(request()->ajax())
        {
            $data = Persona::findOrFail($id);
            return response()->json(['result' => $data]);
        }
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
      $rules = array(
        'nombre'    =>  'required',
        'cedula'     =>  'required',
        'telefono'     =>  'required',
        'email'     =>  'required',
        'genero'     =>  'required'
    );

    $error = Validator::make($request->all(), $rules);

    if($error->fails())
    {
        return response()->json(['errors' => $error->errors()->all()]);
    }

    $form_data = array(
      'nombre'        =>  $request->nombre,
      'cedula'         =>  $request->cedula,
      'telefono'     =>  $request->telefono,
      'email'     =>  $request->email,
      'genero'     =>  $request->genero
  );

    Persona::whereId($request->hidden_id)->update($form_data);

    return response()->json(['success' => 'Data is successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $data = Persona::findOrFail($id);
        $data->delete();
    }
}