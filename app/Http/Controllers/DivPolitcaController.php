<?php

namespace App\Http\Controllers;
use App\Divpolitica;
use Illuminate\Http\Request;
use DataTables;
use Validator;
class DivPolitcaController extends Controller
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
        $ciudadpdre=Divpolitica::all();
        if($request->ajax())
        {
            $data = Divpolitica::latest()->get();
            return DataTables::of($data)->addColumn('cidudad',function($data){
                return $data->Parent['nomdivision'];
            })
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit"> Editar</button>';
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="edit" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"> Eliminar</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('divpoliticas.index',compact('ciudadpdre'));
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
           // 'parent_id'    =>  'required',
            'nomdivision'     =>  'required',
            'nivel'     =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
    
        $form_data = array(
            'parent_id'        =>  $request->parent_id,
            'nomdivision'         =>  $request->nomdivision,
            'nivel'     =>  $request->nivel,
        );

        Divpolitica::create($form_data);

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
            $data = Divpolitica::findOrFail($id);
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
            'parent_id'    =>  'required',
            'nomdivision'     =>  'required',
            'nivel'     =>  'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'parent_id'        =>  $request->parent_id,
            'nomdivision'         =>  $request->nomdivision,
            'nivel'     =>  $request->nivel,
        );

        Divpolitica::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data is successfully updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy($id)
    {
        $data = Divpolitica::findOrFail($id);
        $data->delete();
    }

    
}
