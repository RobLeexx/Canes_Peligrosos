<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class ArticulosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articulos = Articulo::all();
        $articulos =$articulos[0];
        return Inertia::render('home', compact('articulos'), ['canLogin' => Route::has('login'),'canRegister' => Route::has('register'),]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $articulo = Articulo::all();
        $articulo = $articulo[0];
        /* La Paz */
        if($request->hasFile('fileLP'))
        {
            $destination_path = 'public/articulos';
            $archivoLP = $request->file('fileLP');
            $lpName = $archivoLP->getClientOriginalName();
            if($articulo['fileLP'] == $lpName)
            {
                $name1 = 'Nuevo_';
                $name1 .= $lpName;
                $lpName = $name1;
            }
            $path = $request->file('fileLP')->storeAs($destination_path,$lpName);

            $articulo->fileLP = $lpName;
        }
        /* Cochabamba */
        if($request->hasFile('fileCB'))
        {
            $destination_path = 'public/articulos';
            $archivoCB = $request->file('fileCB');
            $cbName = $archivoCB->getClientOriginalName();
            if($articulo['fileCB'] == $cbName)
            {
                $name2 = 'Nuevo_';
                $name2 .= $cbName;
                $cbName = $name2;
            }
            $path = $request->file('fileCB')->storeAs($destination_path,$cbName);

            $articulo->fileCB = $cbName;
        }
        /* Santa Cruz */
        if($request->hasFile('fileSC'))
        {
            $destination_path = 'public/articulos';
            $archivoSC = $request->file('fileSC');
            $scName = $archivoSC->getClientOriginalName();
            if($articulo['fileSC'] == $scName)
            {
                $name3 = 'Nuevo_';
                $name3 .= $scName;
                $scName = $name3;
            }
            $path = $request->file('fileSC')->storeAs($destination_path,$scName);

            $articulo->fileSC = $scName;
        }
        /* Oruro */
        if($request->hasFile('fileOR'))
        {
            $destination_path = 'public/articulos';
            $archivoOR = $request->file('fileOR');
            $orName = $archivoOR->getClientOriginalName();
            if($articulo['fileOR'] == $orName)
            {
                $name4 = 'Nuevo_';
                $name4 .= $orName;
                $orName = $name4;
            }
            $path = $request->file('fileOR')->storeAs($destination_path,$orName);

            $articulo->fileOR = $orName;
        }
        /* Sucre */
        if($request->hasFile('fileSU'))
        {
            $destination_path = 'public/articulos';
            $archivoSU = $request->file('fileSU');
            $suName = $archivoSU->getClientOriginalName();
            if($articulo['fileSU'] == $suName)
            {
                $name5 = 'Nuevo_';
                $name5 .= $suName;
                $suName = $name5;
            }
            $path = $request->file('fileSU')->storeAs($destination_path,$suName);

            $articulo->fileSU = $suName;
        }
         /* Potosí */
         if($request->hasFile('filePT'))
         {
             $destination_path = 'public/articulos';
             $archivoPT = $request->file('filePT');
             $ptName = $archivoPT->getClientOriginalName();
             if($articulo['filePT'] == $ptName)
             {
                 $name6 = 'Nuevo_';
                 $name6 .= $ptName;
                 $ptName = $name6;
             }
             $path = $request->file('filePT')->storeAs($destination_path,$ptName);
 
             $articulo->filePT = $ptName;
         }
        unset($input['fileLP'], $input['fileCB'], $input['fileSC'], $input['fileOR'], $input['fileSU'], $input['filePT']);
        $articulo->fill($input)->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\grupos  $grupos
     * @return \Illuminate\Http\Response
     */
    public function show(grupos $grupos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\grupos  $grupos
     * @return \Illuminate\Http\Response
     */
    public function edit(articulos $articulo)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\grupos  $grupos
     * @return \Illuminate\Http\Response
     */
    public function update(Articulo $articulo, Request $request)
    {
        /*$input = $request->all();
        $articulo = Articulo::all();
        $articulo = $articulo[0];
        $articulo->fill($input)->save();

        return $input;*/
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\grupos  $grupos
     * @return \Illuminate\Http\Response
     */
    public function destroy(grupos $grupos)
    {
        //
    }
}
