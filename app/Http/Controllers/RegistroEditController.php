<?php

namespace App\Http\Controllers;

use App\Models\Memorial;
use App\Models\Propietario;
use App\Models\Antecedente;
use App\Models\Seguro;
use App\Models\Can;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class RegistroEditController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Propietario $propietario)
    {
        $propID = $propietario['id'];
        $canes = Can::whereIn('id',[$propID])->get();
        $can = $canes[0];
        $memoriales = Memorial::whereIn('id',[$propID])->get();
        $memorial = $memoriales[0];
        $antecedentes = Antecedente::whereIn('id',[$propID])->get();
        $antecedente = $antecedentes[0];
        $seguros = Seguro::whereIn('id',[$propID])->get();
        $seguro = $seguros[0];
        return Inertia::render('ListaEditar', compact('propietario', 'memorial', 'can', 'antecedente', 'seguro'));
    }
    public function update(Request $request, Propietario $propietario)
    {
        $input = $request->all();
        $propID = $propietario['id'];
        $propDOC = $propietario['documento'];
        
        if($request->hasFile('docFile'))
        {
            $destination_path = 'public/doc/identificaciones';
            $ide = $request->file('docFile');
            $ide_name = $propDOC.'_';
            $ide_name .= $ide->getClientOriginalName();
            $path = $request->file('docFile')->storeAs($destination_path,$ide_name);

            $input['docFile'] = $ide_name;
            $propietario->update(['docFile'=>$input['docFile']]);
        }
        unset($input['docFile']);
        $propietario->fill($input)->save();
        
        $memoriales = Memorial::whereIn('id',[$propID])->get();
        $memorial = $memoriales[0];
        if($request->hasFile('memoFile'))
        {
            $destination_path = 'public/doc/memos';
            $doc = $request->file('memoFile');
            $doc_name = $doc->getClientOriginalName();
            $path = $request->file('memoFile')->storeAs($destination_path,$doc_name);

            $input['memoFile'] = $doc_name;
            $memo = $memoriales['memoFile'];
            $memo->fill($input)->save();
        }
        $memorial->fill($input)->save();
        return Redirect::route('registros.index');
    }
}