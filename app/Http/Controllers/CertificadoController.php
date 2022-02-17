<?php

namespace App\Http\Controllers;

use App\Models\Memorial;
use App\Models\Propietario;
use App\Models\Antecedente;
use App\Models\Seguro;
use App\Models\Can;
use App\Models\Capacitacion;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CertificadoController extends Controller
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
        $canes = Can::whereIn('id',[$propID])->get();
        $can = $canes[0];
        $memoriales = Memorial::whereIn('id',[$propID])->get();
        $memorial = $memoriales[0];
        $capacitaciones = Capacitacion::whereIn('id',[$propID])->get();
        $capacitacion = $capacitaciones[0];
        return Inertia::render('Certificado', compact('propietario', 'memorial', 'can', 'capacitacion'));
    }
}
