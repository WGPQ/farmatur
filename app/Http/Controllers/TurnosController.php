<?php

namespace App\Http\Controllers;
use App\Turnos;
use App\Farmacias;
use Illuminate\Http\Request;
use DataTables;
use Validator;

class TurnosController extends Controller
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
        $farmacias=Farmacias::all();
        if($request->ajax())
        {
            $data = Turnos::latest()->get();
            return DataTables::of($data)->addColumn('farmacia',function($data){
                return $data->Farmacia['nomfarmacia'];
            })
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit"> Editar</button>';
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"> Eliminar</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('turnos.index',compact('farmacias'));
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
            'idfarmacia'    =>  'required',
            'fecha_inicio'     =>  'required',
            'fecha_fin'     =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
    
        $form_data = array(
            'idfarmacia'        =>  $request->idfarmacia,
            'fecha_inicio'         =>  $request->fecha_inicio,
            'fecha_fin'     =>  $request->fecha_fin,
        );

        Turnos::create($form_data);

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
            $data = Turnos::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = array(
            'idfarmacia'    =>  'required',
            'fecha_inicio'     =>  'required',
            'fecha_fin'     =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'idfarmacia'        =>  $request->idfarmacia,
            'fecha_inicio'         =>  $request->fecha_inicio,
            'fecha_fin'     =>  $request->fecha_fin,
        );

        Turnos::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy($id)
    {
        $data = Turnos::findOrFail($id);
        $data->delete();
    }

}
