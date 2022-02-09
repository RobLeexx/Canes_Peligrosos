<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class UsuarioController extends Controller
{
    public function index(){
        $usuarios = User::select('id','username','paterno','materno','nombres')->whereNotNull('id')->get();
        return Inertia::render('usuarios', ['usuarios' => $usuarios]);
    }
}
