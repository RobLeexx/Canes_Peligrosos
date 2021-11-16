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
            $imageProp = $request->file('fotoProp');
            $image_PropName = $imageProp->getClientOriginalName();
            $path = $request->file('fotoProp')->storeAs($destination_path,$image_PropName);

            $input['fotoProp'] = $image_PropName;
        }
        if($request->hasFile('fotoCan'))
        {
            $destination_path = 'public/images/photos';
            $imageCan = $request->file('fotoCan');
            $image_CanName = $imageCan->getClientOriginalName();
            $path = $request->file('fotoCan')->storeAs($destination_path,$image_CanName);

            $input['fotoCan'] = $image_CanName;
        }
        if($request->hasFile('fotoCan2'))
        {
            $destination_path = 'public/images/photos';
            $imageCan2 = $request->file('fotoCan2');
            $image_Can2Name = $imageCan2->getClientOriginalName();
            $path = $request->file('fotoCan2')->storeAs($destination_path,$image_Can2Name);

            $input['fotoCan'] = $image_Can2Name;
        }
        if($request->hasFile('memoFile'))
        {
            $destination_path = 'public/doc/memos';
            $doc = $request->file('memoFile');
            $doc_name = $doc->getClientOriginalName();
            $path = $request->file('memoFile')->storeAs($destination_path,$doc_name);

            $input['memoFile'] = $doc_name;
        }

        Memorial::create($input);
        Propietario::create($input);
        Can::create($input);
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
