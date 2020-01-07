<?php

namespace App\Http\Controllers;
use App\Division_Politica;

use Illuminate\Http\Request;
use DataTables;
use Validator;
class DivPolitcaController extends Controller
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
        if($request->ajax())
        {
            $data = Division_Politica::latest()->get();
            return DataTables::of($data)
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('divpoliticas.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'parent_id'    =>  'required',
            'id_division'     =>  'required',
            'nomfarmacia'     =>  'required',
            'telefono'     =>  'required',
            'direccion'     =>  'required',
            'longitud'     =>  'required',
            'latitud'     =>  'required',
            'jerarquia'     =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'parent_id'        =>  $request->parent_id,
            'id_division'         =>  $request->id_division,
            'nomfarmacia'     =>  $request->nomfarmacia,
            'telefono'     =>  $request->telefono,
            'direccion'     =>  $request->direccion,
            'longitud'     =>  $request->longitud,
            'latitud'     =>  $request->latitud,
            'jerarquia'     =>  $request->jerarquia
        );

        Farmacias::create($form_data);

        return response()->json(['success' => 'Data Added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Farmacias  $farmacias
     * @return \Illuminate\Http\Response
     */
    public function show(Farmacias $farmacias)
    {
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Farmacias  $farmacias
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Farmacias::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Farmacias  $farmacias
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Farmacias $farmacias)
    {
        $rules = array(
            'parent_id'    =>  'required',
            'id_division'     =>  'required',
            'nomfarmacia'     =>  'required',
            'telefono'     =>  'required',
            'direccion'     =>  'required',
            'longitud'     =>  'required',
            'latitud'     =>  'required',
            'jerarquia'     =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'parent_id'        =>  $request->parent_id,
            'id_division'         =>  $request->id_division,
            'nomfarmacia'     =>  $request->nomfarmacia,
            'telefono'     =>  $request->telefono,
            'direccion'     =>  $request->direccion,
            'longitud'     =>  $request->longitud,
            'latitud'     =>  $request->latitud,
            'jerarquia'     =>  $request->jerarquia
        );

        Farmacias::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Farmacia  $farmacia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Farmacias::findOrFail($id);
        $data->delete();
    }
}
