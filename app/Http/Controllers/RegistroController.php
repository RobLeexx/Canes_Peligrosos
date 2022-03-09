<?php

namespace App\Http\Controllers;

use App\Models\Memorial;
use App\Models\Propietario;
use App\Models\Antecedente;
use App\Models\Seguro;
use App\Models\Can;
use App\Models\Capacitacion;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class RegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $propietarios = Propietario::all();
        $canes = Can::all();
        $capacitaciones = Capacitacion::all();
        /* Adjuntos */
        $memo = Memorial::select('id','memoFile')->whereNotNull('id')->get();
        $seguro = Seguro::select('id','seguroFile')->whereNotNull('id')->get();
        $antecedentes = Antecedente::select('id','aCanesFile','aRejapFile','aFelccFile','aFelcnFile','aFelcvFile')->whereNotNull('id')->get();
        return Inertia::render('lista', ['propietarios'=>$propietarios, 'canes'=>$canes, 'capacitaciones'=>$capacitaciones, 'seguro'=>$seguro, 'antecedentes'=>$antecedentes, 'memo'=>$memo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('requisitos');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $propDOC = $request->input('documento');
        $canName = $request->input('nomPerro');
        if($request->hasFile('fotoProp'))
        {
            $destination_path = 'public/images/propietarios';
            $imageProp = $request->file('fotoProp');
            $image_PropName = $propDOC.'_';
            $image_PropName .= $imageProp->getClientOriginalName();
            $path = $request->file('fotoProp')->storeAs($destination_path,$image_PropName);

            $input['fotoProp'] = $image_PropName;
        }
        if($request->hasFile('fotoCan1'))
        {
            $destination_path = 'public/images/canes/ci_'.$propDOC;
            $imageCan1 = $request->file('fotoCan1');
            $image_Can1Name = $canName.'_';
            $image_Can1Name .= $imageCan1->getClientOriginalName();
            $path = $request->file('fotoCan1')->storeAs($destination_path,$image_Can1Name);

            $input['fotoCan1'] = $image_Can1Name;
        }
        if($request->hasFile('fotoCan2'))
        {
            $destination_path = 'public/images/canes/ci_'.$propDOC;
            $imageCan2 = $request->file('fotoCan2');
            $image_Can2Name = $canName.'_';
            $image_Can2Name .= $imageCan2->getClientOriginalName();
            $path = $request->file('fotoCan2')->storeAs($destination_path,$image_Can2Name);

            $input['fotoCan2'] = $image_Can2Name;
        }
        if($request->hasFile('fotoCan3'))
        {
            $destination_path = 'public/images/canes/ci_'.$propDOC;
            $imageCan3 = $request->file('fotoCan3');
            $image_Can3Name = $canName.'_';
            $image_Can3Name .= $imageCan3->getClientOriginalName();
            $path = $request->file('fotoCan3')->storeAs($destination_path,$image_Can3Name);

            $input['fotoCan3'] = $image_Can3Name;
        }
        if($request->hasFile('fotoCan4'))
        {
            $destination_path = 'public/images/canes/ci_'.$propDOC;
            $imageCan4 = $request->file('fotoCan4');
            $image_Can4Name = $canName.'_';
            $image_Can4Name .= $imageCan4->getClientOriginalName();
            $path = $request->file('fotoCan4')->storeAs($destination_path,$image_Can4Name);

            $input['fotoCan4'] = $image_Can4Name;
        }
        if($request->hasFile('fotoCan5'))
        {
            $destination_path = 'public/images/canes/ci_'.$propDOC;
            $imageCan5 = $request->file('fotoCan5');
            $image_Can5Name = $canName.'_';
            $image_Can5Name .= $imageCan5->getClientOriginalName();
            $path = $request->file('fotoCan5')->storeAs($destination_path,$image_Can5Name);

            $input['fotoCan5'] = $image_Can5Name;
        }
        if($request->hasFile('memoFile'))
        {
            $destination_path = 'public/doc/memos';
            $doc = $request->file('memoFile');
            $doc_name = $propDOC.'_';
            $doc_name .= $doc->getClientOriginalName();
            $path = $request->file('memoFile')->storeAs($destination_path,$doc_name);

            $input['memoFile'] = $doc_name;
        }
        if($request->hasFile('docFile'))
        {
            $destination_path = 'public/doc/identificaciones';
            $ide = $request->file('docFile');
            $ide_name = $propDOC.'_';
            $ide_name .= $ide->getClientOriginalName();
            $path = $request->file('docFile')->storeAs($destination_path,$ide_name);

            $input['docFile'] = $ide_name;
        }
        if($request->hasFile('boleta'))
        {
            $destination_path = 'public/doc/boletas';
            $bol = $request->file('boleta');
            $bol_name = $propDOC.'_';
            $bol_name .= $bol->getClientOriginalName();
            $path = $request->file('boleta')->storeAs($destination_path,$bol_name);

            $input['boleta'] = $bol_name;
        }
        if($request->hasFile('aCanesFile'))
        {
            $destination_path = 'public/doc/antecedentes';
            $aCanes = $request->file('aCanesFile');
            $aCanes_name = $propDOC.'_';
            $aCanes_name .= $aCanes->getClientOriginalName();
            $path = $request->file('aCanesFile')->storeAs($destination_path,$aCanes_name);

            $input['aCanesFile'] = $aCanes_name;
        }
        if($request->hasFile('aRejapFile'))
        {
            $destination_path = 'public/doc/antecedentes';
            $aRejap = $request->file('aRejapFile');
            $aRejap_name = $propDOC.'_';
            $aRejap_name .= $aRejap->getClientOriginalName();
            $path = $request->file('aRejapFile')->storeAs($destination_path,$aRejap_name);

            $input['aRejapFile'] = $aRejap_name;
        }
        if($request->hasFile('aFelccFile'))
        {
            $destination_path = 'public/doc/antecedentes';
            $aFelcc = $request->file('aFelccFile');
            $aFelcc_name = $propDOC.'_';
            $aFelcc_name .= $aFelcc->getClientOriginalName();
            $path = $request->file('aFelccFile')->storeAs($destination_path,$aFelcc_name);

            $input['aFelccFile'] = $aFelcc_name;
        }
        if($request->hasFile('aFelcnFile'))
        {
            $destination_path = 'public/doc/antecedentes';
            $aFelcn = $request->file('aFelcnFile');
            $aFelcn_name = $propDOC.'_';
            $aFelcn_name .= $aFelcn->getClientOriginalName();
            $path = $request->file('aFelcnFile')->storeAs($destination_path,$aFelcn_name);

            $input['aFelcnFile'] = $aFelcn_name;
        }
        if($request->hasFile('aFelcvFile'))
        {
            $destination_path = 'public/doc/antecedentes';
            $aFelcv = $request->file('aFelcvFile');
            $aFelcv_name = $propDOC.'_';
            $aFelcv_name .= $aFelcv->getClientOriginalName();
            $path = $request->file('aFelcvFile')->storeAs($destination_path,$aFelcv_name);

            $input['aFelcvFile'] = $aFelcv_name;
        }
        if($request->hasFile('seguroFile'))
        {
            $destination_path = 'public/doc/seguros';
            $seguro = $request->file('seguroFile');
            $seguro_name = $propDOC.'_';
            $seguro_name .= $seguro->getClientOriginalName();
            $path = $request->file('seguroFile')->storeAs($destination_path,$seguro_name);

            $input['seguroFile'] = $seguro_name;
        }
        if($request->hasFile('vacFile'))
        {
            $destination_path = 'public/doc/veterinaria';
            $vac = $request->file('vacFile');
            $vac_name = $propDOC.'_';
            $vac_name .= $vac->getClientOriginalName();
            $path = $request->file('vacFile')->storeAs($destination_path,$vac_name);

            $input['vacFile'] = $vac_name;
        }
        if($request->hasFile('estFile'))
        {
            $destination_path = 'public/doc/veterinaria';
            $est = $request->file('estFile');
            $est_name = $propDOC.'_';
            $est_name .= $est->getClientOriginalName();
            $path = $request->file('estFile')->storeAs($destination_path,$est_name);

            $input['estFile'] = $est_name;
        }
        /* Antecedentes Caninos */
        if($request->hasFile('canAntFile'))
        {
            $destination_path = 'public/doc/antecedentes';
            $canAnt = $request->file('canAntFile');
            $canAnt_name = $propDOC.'_';
            $canAnt_name .= $canAnt->getClientOriginalName();
            $path = $request->file('canAntFile')->storeAs($destination_path,$canAnt_name);

            $input['canAntFile'] = $canAnt_name;
        }

        Memorial::create($input);
        $uuid = Propietario::create($input)->uuid;
        Antecedente::create($input);
        Seguro::create($input);
        Can::create($input);
        Capacitacion::create($input);
        /* QR */
        QrCode::format('png')->size(100)->generate('https://cac.policia.bo/registros/qr/'.$uuid, '../public/storage/qr/'.$propDOC.'.png');
        /*QrCode::generate('https://cac.policia.bo/registros/qr/'.$uuid, '../public/storage/qr/'.$propDOC.'.svg');*/

        return Redirect::route('registros.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Memorial  $memorial
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Memorial  $memorial
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Memorial  $memorial
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Memorial  $memorial
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
