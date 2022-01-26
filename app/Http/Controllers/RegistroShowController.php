<?php

namespace App\Http\Controllers;

use App\Models\Memorial;
use App\Models\Propietario;
use App\Models\Antecedente;
use App\Models\Seguro;
use App\Models\Can;
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
        $secs = User::whereIn('id',[$secID])->get();
        $sec = $secs[0];
        return Inertia::render('ListaMostrar', compact('propietario', 'memorial', 'can', 'antecedente', 'seguro', 'sec'));
    }
}
