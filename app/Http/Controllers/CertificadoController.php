<?php

namespace App\Http\Controllers;

use App\Models\Memorial;
use App\Models\Propietario;
use App\Models\Antecedente;
use App\Models\Seguro;
use App\Models\Can;
use Illuminate\Http\Request;
use Inertia\Inertia;
use PDF;
use App;
use resources\js\Pages\Certificado;

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
        $canes = Can::all();
        $memoriales = Memorial::all();
        $antecedentes = Antecedente::all();
        $seguros = Seguro::all();

        /* PDF */
        /*$pdf = App::make('dompdf.wrapper');*/
        /*$pdf = PDF::loadHTML('<h1>Test</h1>');*/
        /*$pdf = PDF::loadView('certificado.pdf', compact('propietario', 'memoriales', 'canes', 'antecedentes', 'seguros'));*/
        /*return $pdf->download('Certificado.pdf');*/
        return Inertia::render('Certificado', compact('propietario', 'memoriales', 'canes', 'antecedentes', 'seguros'));
    }
}
