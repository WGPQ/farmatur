<?php

namespace App\Http\Controllers;

use App\Divpolitica;
use Illuminate\Http\Request;

class DivpoliticaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $divpoliticas=Divpolitica::latest()->paginate(5);
        return view('divpoliticas.index',compact('divpoliticas'))->with('i',(request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    return view('divpoliticas.create');
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
'idpadre'=>'required',
'nomdivision'=>'required',
'nivel'=>'required',

       ]);
       Divpolitica::create($request->all());
       return redirect()->route('divpoliticas.index')->with('success','Blog created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Divpolitica  $divpolitica
     * @return \Illuminate\Http\Response
     */
    public function show(Divpolitica $divpolitica)
    {
        return view('divpoliticas.show',compact('divpolitica'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Divpolitica  $divpolitica
     * @return \Illuminate\Http\Response
     */
    public function edit(Divpolitica $divpolitica)
    {
        return view('divpoliticas.edit',compact('divpolitica'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Divpolitica  $divpolitica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Divpolitica $divpolitica)
    {
        $request->validate([
            'idpadre'=>'required',
            'nomdivision'=>'required',
            'nivel'=>'required',
            
                   ]);
                   Divpolitica::update($request->all());
                   return redirect()->route('divpoliticas.index')->with('success','Blog created successfully.');     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Divpolitica  $divpolitica
     * @return \Illuminate\Http\Response
     */
    public function destroy(Divpolitica $divpolitica)
    {
        $divpolitica->delete();
        return redirect()->route('divpoliticas.index')->with('success','Blog delete successfully.');
    }
}