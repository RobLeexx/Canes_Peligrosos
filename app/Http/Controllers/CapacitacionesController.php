<?php

namespace App\Http\Controllers;

use App\Models\Propietario;
use App\Models\Can;
use App\Models\Grupo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class CapacitacionesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $cac = Auth::user()->departamento;
        $username = Auth::user()->username;
        $propietarios = Propietario::select('id','fotoProp', 'paterno', 'materno', 'nombres', 'documento')->whereIn('cac',[$cac])->get();
        $canes = Can::select('id','nomPerro')->whereNotNull('id')->get();
        $users = User::whereIn('departamento',[$cac])->get();
        $grupos = Grupo::whereIn('capacitador',[$username])->get();
        return Inertia::render('capacitaciones', ['propietarios'=>$propietarios, 'canes'=>$canes, 'users'=>$users, 'grupos'=>$grupos]);
    }
    public function update()
    {

    }
}