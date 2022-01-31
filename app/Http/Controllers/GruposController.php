<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Propietario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class GruposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $input = $request->all();
        $idGroup = Grupo::create($input)->id;
        $propIDS = $request->input('integrantes');
        $propIDS = explode(',',trim($propIDS));
        $length= count($propIDS);

        for($n = 0; $n < $length; $n++)
        {
            $propID = $propIDS[$n];
            $propietarios = Propietario::find($propID);
            $propietarios->grupo = $idGroup;
            $propietarios->save();
        };
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\grupos  $grupos
     * @return \Illuminate\Http\Response
     */
    public function show(grupos $grupos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\grupos  $grupos
     * @return \Illuminate\Http\Response
     */
    public function edit(grupos $grupos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\grupos  $grupos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, grupos $grupos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\grupos  $grupos
     * @return \Illuminate\Http\Response
     */
    public function destroy(grupos $grupos)
    {
        //
    }
}
