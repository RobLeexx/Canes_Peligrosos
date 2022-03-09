<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Propietario;
use App\Models\Capacitacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

use function GuzzleHttp\Promise\all;

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
            $capacitaciones->estado = 'En Curso';
            $propietarios->save();
            $capacitaciones->save();
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
    public function update(Request $request, Grupo $grupo)
    {
        $input = $request->all();
        $grupo->fill($input)->save();

        /* Estado Capacitacion Completos */
        $propCom = $grupo['completos'];
        if($propCom)
        {
            $propIDS = explode(',',trim($propCom));
            $length1 = count($propIDS);

            for($n1 = 0; $n1 < $length1; $n1++)
            {
                $propID = $propIDS[$n1];
                $capacitaciones = Capacitacion::find($propID);
                $capacitaciones->estado = 'Finalizado';
                $capacitaciones->asistenciaCompleta = 'Sí';
                $capacitaciones->save();
            };
        }
        else
        {
            $grupo->completos = 'Ninguno';
            $grupo->save();
        }

        /* Estado Capacitacion Incompletos */
        $propIn = $grupo['incompletos'];
        if($propIn)
        {
            $propIDS = explode(',',trim($propIn));
            $length2 = count($propIDS);

            for($n2 = 0; $n2 < $length2; $n2++)
            {
                $propID = $propIDS[$n2];
                $capacitaciones = Capacitacion::find($propID);
                $capacitaciones->estado = 'Incompleto';
                $capacitaciones->asistenciaCompleta = 'No';
                $capacitaciones->save();
            };
        }
        else
        {
            $grupo->incompletos = 'Ninguno';
            $grupo->save();
        }
        /* Observaciones Capacitacion */
        $ints = $grupo['integrantes'];
        $intsIDS = explode(',',trim($ints));
        $obs = $grupo['observados'];
        $obsNumIDS = explode(',',trim($obs));
        $length3 = count($obsNumIDS);

        for($n3 = 0; $n3 < $length3; $n3++)
            {
                $intID = $intsIDS[$n3];
                $capacitaciones = Capacitacion::find($intID);
                $capacitaciones->observaciones = $obsNumIDS[$n3];
                $capacitaciones->save();
            };

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
