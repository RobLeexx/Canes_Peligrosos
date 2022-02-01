<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Propietario;
use App\Models\Capacitacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $capGroup = $request->input('capacitador');
        $tipo = $request->input('tipo');
        $propIDS = explode(',',trim($propIDS));
        $length= count($propIDS);

        for($n = 0; $n < $length; $n++)
        {
            $propID = $propIDS[$n];
            $propietarios = Propietario::find($propID);
            $capacitaciones = Capacitacion::find($propID);
            $propietarios->grupo = $idGroup;
            $capacitaciones->grupoID = $idGroup;
            $capacitaciones->capacitador = $capGroup;
            $capacitaciones->tipoCap = $tipo;
            $propietarios->save();
            $capacitaciones->save();
        };
        $image = \QrCode::format('png')
                 ->merge('img/t.jpg', 0.1, true)
                 ->size(200)->errorCorrection('H')
                 ->generate('A simple example of QR code!');
        $output_file = '/img/qr-code/img-' . time() . '.png';
        Storage::disk('local')->put($output_file, $image);
        
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
    public function update(Grupo $grupo)
    {
        $grupoId = $grupo['id'];
        $grupoEst = $grupo['estado'];

        $grupo2 = Grupo::find($grupoId);
        $grupo2->estado = 'Finalizado';
        $grupo2->save();

        return Redirect::route('capacitaciones');
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
