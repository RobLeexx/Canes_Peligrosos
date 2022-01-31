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
        /* Propietarios */
        $propietarios = Propietario::select('id','fotoProp', 'paterno', 'materno', 'nombres', 'documento')->whereIn('cac',[$cac])->whereIn('grupo',['Ninguno'])->get();
        /* Canes */
        $canes = Can::select('id','nomPerro')->whereNotNull('id')->get();
        /* Usuarios */
        $users = User::whereIn('departamento',[$cac])->get();
        /* Grupos */
        $en_curso = Grupo::whereIn('capacitador',[$username])->whereIn('estado',['En Curso'])->get();
        $incompletos = Grupo::whereIn('capacitador',[$username])->whereIn('estado',['Incompleto'])->get();
        $completos = Grupo::whereIn('capacitador',[$username])->whereIn('estado',['Completo'])->get();
        return Inertia::render('capacitaciones', ['propietarios'=>$propietarios, 'canes'=>$canes, 'users'=>$users, 'en_curso'=>$en_curso, 'incompletos'=>$incompletos, 'completos'=>$completos]);
    }
    public function update()
    {

    }
}