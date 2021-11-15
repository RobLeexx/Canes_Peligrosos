<?php

namespace App\Http\Controllers;

use App\Models\Memorial;
use App\Models\Propietario;
use App\Models\Can;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class RegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $memoriales = Memorial::all();
        $propietarios = Propietario::all();
        $canes = Can::all();
        return Inertia::render('lista', ['memoriales'=>$memoriales, 'propietarios'=>$propietarios, 'canes'=>$canes]);
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
            'dateMemo' => 'required',
            /*'file_memo' => 'required',*/
            'paterno' => 'required',
            'materno' => 'required',
            'nombres' => 'required',
            'latitud' => 'required',
            'longitud' => 'required',
            'cel' => 'required',
        ]);

        $input = $request->all();
        if($request->hasFile('fotoProp'))
        {
            $destination_path = 'public/images/photos';
            $image = $request->file('fotoProp');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('fotoProp')->storeAs($destination_path,$image_name);

            $input['fotoProp'] = $image_name;
        }
        if($request->hasFile('fotoCan'))
        {
            $destination_path = 'public/images/photos';
            $image = $request->file('fotoCan');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('fotoCan')->storeAs($destination_path,$image_name);

            $input['fotoCan'] = $image_name;
        }
        if($request->hasFile('fotoCan2'))
        {
            $destination_path = 'public/images/photos';
            $image = $request->file('fotoCan2');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('fotoCan2')->storeAs($destination_path,$image_name);
        }
        if($request->hasFile('fotoCan2Name'))
        {
            $destination_path = 'public/images/photos';
            $image = $request->file('fotoCan2Name');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('fotoCan2Name')->storeAs($destination_path,$image_name);
        }

        Memorial::create($request->all());
        Propietario::create($request->all());
        Can::create($request->all());
        return Redirect::route('registros.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Memorial  $memorial
     * @return \Illuminate\Http\Response
     */
    public function show(Registro $registro)
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
