<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use DB;

class DownloadController extends Controller
{
    public function downloadMemo($memo)
    {
        $path = public_path('storage/doc/memos/'. $memo);
        return response()->download($path);
    }
    public function downloadDoc($doc)
    {
        $path = public_path('storage/doc/identificaciones/'. $doc);
        return response()->download($path);
    }
    public function downloadBol($boleta)
    {
        $path = public_path('storage/doc/boletas/'. $boleta);
        return response()->download($path);
    }
    public function downloadAntecedente($ant)
    {
        $path = public_path('storage/doc/antecedentes/'. $ant);
        return response()->download($path);
    }
    public function downloadSeguro($seguro)
    {
        $path = public_path('storage/doc/seguros/'. $seguro);
        return response()->download($path);
    }
    public function downloadVet($vac)
    {
        $path = public_path('storage/doc/veterinaria/'. $vac);
        return response()->download($path);
    }

    /* Artículos Públicos */
    public function downloadART($art)
    {
        $path = public_path('storage/articulos/'. $art);
        return response()->download($path);
    }
}
