<?php

namespace App\Http\Controllers;

use App\Persona2;
use Illuminate\Http\Request;

class PersonaController2 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $persona = Persona2::paginate(4);
        return view('persona.index',compact('persona'));
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
            'nombre'=>'required',
            'cedula'=>'required',
            
        ]);
        Persona2::create($request->all());
        return response()->json($persona);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Persona2  $persona2
     * @return \Illuminate\Http\Response
     */
    public function show(Persona2 $persona2)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Persona2  $persona2
     * @return \Illuminate\Http\Response
     */
    public function edit(Persona2 $persona2)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Persona2  $persona2
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Persona2 $persona2)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Persona2  $persona2
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona2 $persona2)
    {
        //
    }
}
