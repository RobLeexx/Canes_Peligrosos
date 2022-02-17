<?php

namespace App\Http\Controllers;

use App\Models\Propietario;
use App\Models\Antecedente;
use App\Models\Seguro;
use App\Models\Can;
use App\Models\User;
use App\Models\Grupo;
use App\Models\Capacitacion;
use Inertia\Inertia;

class QrController extends Controller
{

    public function __invoke($prop)
    {
        $propietarios = Propietario::whereIn('uuid',[$prop])->get();
        $propietario = $propietarios[0];
        $propID = $propietario['id'];
        $secID = $propietario['creado_por'];
        $canes = Can::whereIn('id',[$propID])->get();
        $can = $canes[0];
        $antecedentes = Antecedente::whereIn('id',[$propID])->get();
        $antecedente = $antecedentes[0];
        $capacitaciones = Capacitacion::whereIn('id',[$propID])->get();
        $capacitacion = $capacitaciones[0];
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
            return Inertia::render('Qr_view', compact('propietario', 'can', 'antecedente', 'capacitacion', 'sec', 'grupo', 'cap'));
        }
        else
        {
            return Inertia::render('Qr_view', compact('propietario', 'can', 'antecedente', 'capacitacion', 'sec'));
        }
    }
}
