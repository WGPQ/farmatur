<?php

namespace App\Http\Controllers;

use App\Farmacia;
use Illuminate\Http\Request;

class FarmaciaController extends Controller
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
        
        $farmacias=Farmacia::latest()->paginate(5);
       
        return view('farmacias.index',compact('farmacias'))->with('i',(request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('farmacias.create');
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
            'nomfarmacias'=>'required',
            'id_division'=>'required',
            'telefono'=>'required',
            'direccion'=>'required',
            //'activo'=>1,
            'longitud'=>'required',
            'latitud'=>'required',
            'jerarqua'=>'required',
            
        ]);

        Farmacia::create($request->all());
       /*Farmacia::create([
            'nomfarmacias' => $request['nomfarmacias'],
            'id_division' => $request['id_division'],
            'telefono' =>$request['telefono'],
            'direccion' =>$request['direccion'],
            'longitud' =>$request['longitud'],
            'latitud' =>$request['latitud'],
            'jerarqua' =>$request['jerarqua'],
            //'activo' =>1,
                ]);*/
       return redirect()->route('farmacias.index')->with('success','Blog created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Farmacia  $farmacia
     * @return \Illuminate\Http\Response
     */
    public function show(Farmacia $farmacia)
    {
        
        return view('farmacias.show',compact('farmacia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Farmacia  $farmacia
     * @return \Illuminate\Http\Response
     */
    public function edit(Farmacia $farmacia)
    {
        return view('farmacias.edit',compact('farmacia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Farmacia  $farmacia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Farmacia $farmacia)
    {
        $request->validate([
            'nomfarmacias'=>'required',
            'id_division'=>'required',
            'telefono'=>'required',
            'direccion'=>'required',
            //'activo'=>1,
            'longitud'=>'required',
            'latitud'=>'required',
            'jerarqua'=>'required',
            
        ]);


        $farmacia->update($request->all());
        return redirect()->route('farmacias.index')->with('success','Blog update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Farmacia  $farmacia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Farmacia $farmacia)
    {
        $farmacia->delete();
        return redirect()->route('farmacias.index')->with('success','Blog delete successfully.');
    }
}
