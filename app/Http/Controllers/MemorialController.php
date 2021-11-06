<?php

namespace App\Http\Controllers;

use App\Models\Memorial;
use Illuminate\Http\Request;
use Illuminate\Inertia;
use Illuminate\Support\Facades\Redirect;

class MemorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $memoriales = Memorial::all();
        return Inertia::render('Mostrar', ['memoriales'=>$memoriales]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('requisitos');
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
            'comandante' => 'required',
            'referencia' => 'required',
            'fecha_memo' => 'required',
            'file_memo' => 'required',
        ]);

        Memorial::create($request->all());
        return Redirect::route('lista.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Memorial  $memorial
     * @return \Illuminate\Http\Response
     */
    public function show(Memorial $memorial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Memorial  $memorial
     * @return \Illuminate\Http\Response
     */
    public function edit(Memorial $memorial)
    {
        return Inertia::render('ListaEditar', ['memorial' => $memorial]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Memorial  $memorial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Memorial $memorial)
    {
        $producto->update($request->all);
            return Redirect::route('lista.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Memorial  $memorial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Memorial $memorial)
    {
        //
    }
}
