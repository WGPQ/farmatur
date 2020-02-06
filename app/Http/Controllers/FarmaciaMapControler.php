<?php

namespace App\Http\Controllers;
use App\Divpolitica;
use Illuminate\Http\Request;

class FarmaciaMapControler extends Controller
{
     /**
     * Show the outlet listing in LeafletJS map.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $ciudadp=Divpolitica::all();
        return view('welcome',compact('ciudadp'));
    }
}
