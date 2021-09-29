<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class ListaController extends Controller
{
    public function listaCont(){
        $lista = User::all();
        return Inertia::render('lista', ['lista' => $lista]);
    }
}