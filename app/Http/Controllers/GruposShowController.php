<?php

namespace App\Http\Controllers;

use App\Models\Propietario;
use App\Models\Grupo;
use App\Models\Can;
use App\Models\Capacitacion;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GruposShowController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Grupo $grupo)
    {
        $grupoID = $grupo['id'];

        $propietarios = Propietario::whereIn('grupo', [$grupoID])->get();
        $capacitaciones = Capacitacion::whereIn('grupoID', [$grupoID])->get();

        return Inertia::render('ListaGrupos', compact( 'grupo', 'propietarios', 'capacitaciones'));
    }
}
