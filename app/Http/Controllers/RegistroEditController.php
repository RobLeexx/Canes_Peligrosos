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
        if($request->hasFile('fotoProp'))
        {
            $destination_path = 'public/images/propietarios';
            $imageProp = $request->file('fotoProp');
            $image_PropName = $propDOC.'_';
            $image_PropName .= $imageProp->getClientOriginalName();
            $path = $request->file('fotoProp')->storeAs($destination_path,$image_PropName);

            $input['fotoProp'] = $image_PropName;
            $propietario->update(['fotoProp'=>$input['fotoProp']]);
        }
        unset($input['docFile'],$input['fotoProp']);
        $propietario->fill($input)->save();
        
        /* MEMORIAL */
        $memoriales = Memorial::whereIn('id',[$propID])->get();
        $memorial = $memoriales[0];
        if($request->hasFile('memoFile'))
        {
            $destination_path = 'public/doc/memos';
            $doc = $request->file('memoFile');
            $doc_name = $propDOC.'_';
            $doc_name .= $doc->getClientOriginalName();
            $path = $request->file('memoFile')->storeAs($destination_path,$doc_name);

            $input['memoFile'] = $doc_name;
            $memorial->update(['memoFile'=>$input['memoFile']]);
        
        }
        unset($input['memoFile']);
        $memorial->fill($input)->save();
        
        /* ANTECEDENTE */
        $antecedentes = Antecedente::whereIn('id',[$propID])->get();
        $antecedente = $antecedentes[0];
        if($request->hasFile('aCanesFile'))
        {
            $destination_path = 'public/doc/antecedentes';
            $aCanes = $request->file('aCanesFile');
            $aCanes_name = $propDOC.'_';
            $aCanes_name .= $aCanes->getClientOriginalName();
            $path = $request->file('aCanesFile')->storeAs($destination_path,$aCanes_name);

            $input['aCanesFile'] = $aCanes_name;
            $antecedente->update(['aCanesFile'=>$input['aCanesFile']]);
        }
        if($request->hasFile('aRejapFile'))
        {
            $destination_path = 'public/doc/antecedentes';
            $aRejap = $request->file('aRejapFile');
            $aRejap_name = $propDOC.'_';
            $aRejap_name .= $aRejap->getClientOriginalName();
            $path = $request->file('aRejapFile')->storeAs($destination_path,$aRejap_name);

            $input['aRejapFile'] = $aRejap_name;
            $antecedente->update(['aRejapFile'=>$input['aRejapFile']]);
        }
        if($request->hasFile('aFelccFile'))
        {
            $destination_path = 'public/doc/antecedentes';
            $aFelcc = $request->file('aFelccFile');
            $aFelcc_name = $propDOC.'_';
            $aFelcc_name .= $aFelcc->getClientOriginalName();
            $path = $request->file('aFelccFile')->storeAs($destination_path,$aFelcc_name);

            $input['aFelccFile'] = $aFelcc_name;
            $antecedente->update(['aFelccFile'=>$input['aFelccFile']]);
        }
        if($request->hasFile('aFelcnFile'))
        {
            $destination_path = 'public/doc/antecedentes';
            $aFelcn = $request->file('aFelcnFile');
            $aFelcn_name = $propDOC.'_';
            $aFelcn_name .= $aFelcn->getClientOriginalName();
            $path = $request->file('aFelcnFile')->storeAs($destination_path,$aFelcn_name);

            $input['aFelcnFile'] = $aFelcn_name;
            $antecedente->update(['aFelcnFile'=>$input['aFelcnFile']]);
        }
        if($request->hasFile('aFelcvFile'))
        {
            $destination_path = 'public/doc/antecedentes';
            $aFelcv = $request->file('aFelcvFile');
            $aFelcv_name = $propDOC.'_';
            $aFelcv_name .= $aFelcv->getClientOriginalName();
            $path = $request->file('aFelcvFile')->storeAs($destination_path,$aFelcv_name);

            $input['aFelcvFile'] = $aFelcv_name;
            $antecedente->update(['aFelcvFile'=>$input['aFelcvFile']]);
        }
        unset($input['aCanesFile'],$input['aRejapFile'],$input['aFelccFile'],$input['aFelcnFile'],$input['aFelcvFile']);
        $antecedente->fill($input)->save();

        /* SEGURO */
        $seguros = Seguro::whereIn('id',[$propID])->get();
        $seguro = $seguros[0];
        if($request->hasFile('seguroFile'))
        {
            $destination_path = 'public/doc/seguros';
            $seg = $request->file('seguroFile');
            $seguro_name = $propDOC.'_';
            $seguro_name .= $seg->getClientOriginalName();
            $path = $request->file('seguroFile')->storeAs($destination_path,$seguro_name);

            $input['seguroFile'] = $seguro_name;
            $antecedente->update(['seguroFile'=>$input['seguroFile']]);
        }
        unset($input['seguroFile']);
        $seguro->fill($input)->save();

        /* CAN */
        $canes = Can::whereIn('id',[$propID])->get();
        $can = $canes[0];
        if($request->hasFile('fotoCan'))
        {
            $destination_path = 'public/images/canes';
            $fotoCan = $request->file('fotoCan');
            $fotoCan_name = $propDOC.'_';
            $fotoCan_name .= $fotoCan->getClientOriginalName();
            $path = $request->file('fotoCan')->storeAs($destination_path,$fotoCan_name);

            $input['fotoCan'] = $fotoCan_name;
            $can->update(['fotoCan'=>$input['fotoCan']]);
        }
        if($request->hasFile('fotoCan2'))
        {
            $destination_path = 'public/images/canes';
            if($can['fotoCan'])
            {
                $can->update(['fotoCan'=> null]);
            }
            $fotoCan2 = $request->file('fotoCan2');
            $fotoCan2_name = $propDOC.'_';
            $fotoCan2_name .= $fotoCan2->getClientOriginalName();
            $path = $request->file('fotoCan2')->storeAs($destination_path,$fotoCan2_name);

            $input['fotoCan2'] = $fotoCan2_name;
            $can->update(['fotoCan2'=>$input['fotoCan2']]);
        }
        if($request->hasFile('vacFile'))
        {
            $destination_path = 'public/doc/veterinaria';
            $vac = $request->file('vacFile');
            $vac_name = $propDOC.'_';
            $vac_name .= $vac->getClientOriginalName();
            $path = $request->file('vacFile')->storeAs($destination_path,$vac_name);

            $input['vacFile'] = $vac_name;
            $can->update(['vacFile'=>$input['vacFile']]);
        }
        if($request->hasFile('estFile'))
        {
            $destination_path = 'public/doc/veterinaria';
            $est = $request->file('estFile');
            $est_name = $propDOC.'_';
            $est_name .= $est->getClientOriginalName();
            $path = $request->file('estFile')->storeAs($destination_path,$est_name);

            $input['estFile'] = $est_name;
            $can->update(['estFile'=>$input['estFile']]);
        }
        unset($input['vacFile'],$input['estFile'],$input['fotoCan'],$input['fotoCan2']);
        $can->fill($input)->save();

        return Redirect::route('registros.index');
    }
}