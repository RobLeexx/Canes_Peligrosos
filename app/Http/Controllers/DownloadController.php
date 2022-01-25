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
    public function downloadCanes($canesFile)
    {
        $path = public_path('storage/doc/antecedentes/'. $canesFile);
        return response()->download($path);
    }
    public function downloadRejap($rejap)
    {
        $path = public_path('storage/doc/antecedentes/'. $rejap);
        return response()->download($path);
    }
    public function downloadFelcc($felcc)
    {
        $path = public_path('storage/doc/antecedentes/'. $felcc);
        return response()->download($path);
    }
    public function downloadFelcn($felcn)
    {
        $path = public_path('storage/doc/antecedentes/'. $felcn);
        return response()->download($path);
    }
    public function downloadFelcv($felcv)
    {
        $path = public_path('storage/doc/antecedentes/'. $felcv);
        return response()->download($path);
    }
    public function downloadSeguro($seguro)
    {
        $path = public_path('storage/doc/seguros/'. $seguro);
        return response()->download($path);
    }
    public function downloadVac($vac)
    {
        $path = public_path('storage/doc/veterinaria/'. $vac);
        return response()->download($path);
    }
    public function downloadEst($est)
    {
        $path = public_path('storage/doc/veterinaria/'. $est);
        return response()->download($path);
    }
}
