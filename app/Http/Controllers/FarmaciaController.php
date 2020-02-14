<?php

namespace App\Http\Controllers;

use App\Farmacias;
use App\Divpolitica;
use Illuminate\Http\Request;
use DataTables;
use Validator;

class FarmaciaController extends Controller
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
        $ciudadp=Divpolitica::all();
        if($request->ajax())
        {
            $data = Farmacias::latest()->get();
            return DataTables::of($data)->addColumn('ciudad',function($data){
                return $data->Ciudad['nomdivision'];
            })
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit"></button>';
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('farmacias.index',compact('ciudadp'));
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
            'id_division'         =>  $request->id_division,
            'nomfarmacia'     =>  $request->nomfarmacia,
            'telefono'     =>  $request->telefono,
            'direccion'     =>  $request->direccion,
            'longitude'     =>  $request->longitud,
            'latitude'     =>  $request->latitud,
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
            'id_division'         =>  $request->id_division,
            'nomfarmacia'     =>  $request->nomfarmacia,
            'telefono'     =>  $request->telefono,
            'direccion'     =>  $request->direccion,
            'longitude'     =>  $request->longitud,
            'latitude'     =>  $request->latitud,
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

    public function farmacia_ciudad($id)
    {
          if(request()->ajax())
        {
            $data = Farmacias::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }
}
