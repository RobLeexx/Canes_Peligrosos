<?php

namespace App\Http\Controllers;

use App\Models\Memorial;
use App\Models\Propietario;
use App\Models\Antecedente;
use App\Models\Seguro;
use App\Models\Grupo;
use App\Models\Can;
use App\Models\Capacitacion;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RegistroShowController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Propietario $propietario)
    {
        $propID = $propietario['id'];
        $secID = $propietario['creado_por'];

        $canes = Can::whereIn('id',[$propID])->get();
        $can = $canes[0];
        $memoriales = Memorial::whereIn('id',[$propID])->get();
        $memorial = $memoriales[0];
        $antecedentes = Antecedente::whereIn('id',[$propID])->get();
        $antecedente = $antecedentes[0];
        $seguros = Seguro::whereIn('id',[$propID])->get();
        $seguro = $seguros[0];
        $secs = User::whereIn('username',[$secID])->get();
        $sec = $secs[0];

        if($propietario['grupo'] != 'Ninguno')
        {
            $groupID = $propietario['grupo'];
            $grupos = Grupo::whereIn('id',[$groupID])->get();
            $grupo = $grupos[0];
            $grupoCap = $grupo['capacitador'];
            $caps = User::whereIn('username',[$grupoCap])->get();
            $cap = $caps[0];
            $capacitaciones = Capacitacion::whereIn('id',[$propID])->get();
            $capacitacion = $capacitaciones[0];
            return Inertia::render('ListaMostrar', compact('propietario', 'memorial', 'can', 'antecedente', 'seguro', 'sec', 'grupo', 'cap', 'capacitacion'));
        }
        else
        {
            return Inertia::render('ListaMostrar', compact('propietario', 'memorial', 'can', 'antecedente', 'seguro', 'sec'));
        }
    }
}
