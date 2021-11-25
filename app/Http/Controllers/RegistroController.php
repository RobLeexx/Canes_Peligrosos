<?php

namespace App\Http\Controllers;

use App\Models\Memorial;
use App\Models\Propietario;
use App\Models\Antecedente;
use App\Models\Can;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

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
        return Inertia::render('lista', ['propietarios'=>$propietarios, 'canes'=>$canes]);
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
        $request->validate([
            /* MEMORIAL */
            'comandante' => 'required',
            'referencia' => 'required',
            'dateMemo' => 'required',
            /* PROPIETARIO */
            'paterno' => 'required',
            'materno' => 'required',
            'nombres' => 'required',
            'dateProp' => 'required',
            'docTipo' => 'required',
            'documento' => 'required',
            'docExp' => 'required',
            'domicilio' => 'required',
            'fotoProp' => 'required',
            'latitud' => 'required',
            'longitud' => 'required',
            /* ANTECEDENTES */
            'aCanes' => 'required',
            'aFechaHoraCanes' => 'required',
            'aRejap' => 'required',
            'aFechaHoraRejap' => 'required',
            'aFelcc' => 'required',
            'aFechaHoraFelcc' => 'required',
            'aFelcn' => 'required',
            'aFechaHoraFelcn' => 'required',
            'aFelcv' => 'required',
            'aFechaHoraFelcv' => 'required',
        ]);

        $input = $request->all();
        if($request->hasFile('fotoProp'))
        {
            $destination_path = 'public/images/photos';
            $imageProp = $request->file('fotoProp');
            $image_PropName = $imageProp->getClientOriginalName();
            $path = $request->file('fotoProp')->storeAs($destination_path,$image_PropName);

            $input['fotoProp'] = $image_PropName;
        }
        if($request->hasFile('fotoCan'))
        {
            $destination_path = 'public/images/photos';
            $imageCan = $request->file('fotoCan');
            $image_CanName = $imageCan->getClientOriginalName();
            $path = $request->file('fotoCan')->storeAs($destination_path,$image_CanName);

            $input['fotoCan'] = $image_CanName;
        }
        if($request->hasFile('fotoCan2'))
        {
            $destination_path = 'public/images/photos';
            $imageCan2 = $request->file('fotoCan2');
            $image_Can2Name = $imageCan2->getClientOriginalName();
            $path = $request->file('fotoCan2')->storeAs($destination_path,$image_Can2Name);

            $input['fotoCan'] = $image_Can2Name;
        }
        if($request->hasFile('memoFile'))
        {
            $destination_path = 'public/doc/memos';
            $doc = $request->file('memoFile');
            $doc_name = $doc->getClientOriginalName();
            $path = $request->file('memoFile')->storeAs($destination_path,$doc_name);

            $input['memoFile'] = $doc_name;
        }
        if($request->hasFile('docFile'))
        {
            $destination_path = 'public/doc/identificación';
            $ide = $request->file('docFile');
            $ide_name = $ide->getClientOriginalName();
            $path = $request->file('docFile')->storeAs($destination_path,$doc_name);

            $input['docFile'] = $ide_name;
        }
        if($request->hasFile('aCanesFile'))
        {
            $destination_path = 'public/doc/antecedentes';
            $aCanes = $request->file('aCanesFile');
            $aCanes_name = $aCanes->getClientOriginalName();
            $path = $request->file('aCanesFile')->storeAs($destination_path,$aCanes_name);

            $input['aCanesFile'] = $aCanes_name;
        }
        if($request->hasFile('aRejapFile'))
        {
            $destination_path = 'public/doc/antecedentes';
            $aRejap = $request->file('aRejapFile');
            $aRejap_name = $aRejap->getClientOriginalName();
            $path = $request->file('aRejapFile')->storeAs($destination_path,$aRejap_name);

            $input['aRejapFile'] = $aRejap_name;
        }
        if($request->hasFile('aFelccFile'))
        {
            $destination_path = 'public/doc/antecedentes';
            $aFelcc = $request->file('aFelccFile');
            $aFelcc_name = $aFelcc->getClientOriginalName();
            $path = $request->file('aFelccFile')->storeAs($destination_path,$aFelcc_name);

            $input['aFelccFile'] = $aFelcc_name;
        }
        if($request->hasFile('aFelcnFile'))
        {
            $destination_path = 'public/doc/antecedentes';
            $aFelcn = $request->file('aFelcnFile');
            $aFelcn_name = $aFelcn->getClientOriginalName();
            $path = $request->file('aFelcnFile')->storeAs($destination_path,$aFelcn_name);

            $input['aFelcnFile'] = $aFelcn_name;
        }
        if($request->hasFile('aFelcvFile'))
        {
            $destination_path = 'public/doc/antecedentes';
            $aFelcv = $request->file('aFelcvFile');
            $aFelcv_name = $aFelcv->getClientOriginalName();
            $path = $request->file('aFelcvFile')->storeAs($destination_path,$aFelcv_name);

            $input['aFelcvFile'] = $aFelcv_name;
        }

        Memorial::create($input);
        Propietario::create($input);
        Antecedente::create($input);
        Can::create($input);
        return Redirect::route('registros.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Memorial  $memorial
     * @return \Illuminate\Http\Response
     */
    public function show(Registro $registro)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Memorial  $memorial
     * @return \Illuminate\Http\Response
     */
    public function edit(Memorial $memorial)
    {
        return Inertia::render('ListaEditar', ['memorial' => $memorial]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Memorial  $memorial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Memorial $memorial)
    {
        $producto->update($request->all);
            return Redirect::route('lista.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Memorial  $memorial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Memorial $memorial)
    {
        //
    }
}
