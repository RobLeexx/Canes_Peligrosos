<?php

namespace App\Http\Controllers;

use App\Models\Memorial;
use App\Models\Propietario;
use App\Models\Can;
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
        $canes = Can::all();
        $memoriales = Memorial::all();
        return Inertia::render('ListaMostrar', compact('propietario', 'memoriales', 'canes'));
    }
}
