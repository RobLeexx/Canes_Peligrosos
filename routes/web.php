<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Use App\Http\Controllers\UsuarioController;
Use App\Http\Controllers\ListaController;
Use App\Http\Controllers\RegistroController;
Use App\Http\Controllers\RegistroShowController;
Use App\Http\Controllers\RegistroEditController;
Use App\Http\Controllers\DownloadController;
Use App\Http\Controllers\CertificadoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::group(['middleware' => ['auth:sanctum', 'verified']], function(){
    
    Route::get('/home', function () {
        return Inertia::render('home');
    })->name('home');
    
    Route::get('/capacitaciones', function () {
        return Inertia::render('capacitaciones');
    })->name('capacitaciones');
    
    Route::get('/lista', [ListaController::class, 'listaCont'])->name('lista');
    
    Route::resource('registros', RegistroController::class)->except('show','edit','update','destroy');

    Route::get('/registros/{propietario}', RegistroShowController::class)->name('registros.show');

    Route::get('/registros/{propietario}/editar', RegistroEditController::class)->name('registros.edit');

    Route::match(['put', 'patch', 'post'], '/registros/{propietario}', [RegistroEditController::class, 'update'])->name('registros.update');

    Route::get('/memos/{memo}', [DownloadController::class, 'downloadMemo'])->name('downloadMemo');

    Route::get('/identificaciones/{doc}', [DownloadController::class, 'downloadDoc'])->name('downloadDoc');

    Route::get('/boletas/{boleta}', [DownloadController::class, 'downloadBol'])->name('downloadBol');

    Route::get('/antecedentes/{canesFile}', [DownloadController::class, 'downloadCanes'])->name('downloadCanes');

    Route::get('/antecedentes/{rejap}', [DownloadController::class, 'downloadRejap'])->name('downloadRejap');

    Route::get('/antecedentes/{felcc}', [DownloadController::class, 'downloadFelcc'])->name('downloadFelcc');

    Route::get('/antecedentes/{felcn}', [DownloadController::class, 'downloadFelcn'])->name('downloadFelcn');

    Route::get('/antecedentes/{felcv}', [DownloadController::class, 'downloadFelcv'])->name('downloadFelcv');

    Route::get('/seguros/{seguro}', [DownloadController::class, 'downloadSeguro'])->name('downloadSeguro');

    Route::get('/veterinaria/{vac}', [DownloadController::class, 'downloadVac'])->name('downloadVac');

    Route::get('/veterinaria/{est}', [DownloadController::class, 'downloadEst'])->name('downloadEst');

    Route::get('/veterinaria/{vet}', [DownloadController::class, 'downloadVet'])->name('downloadVet');

    Route::get('/registros/{propietario}/pdf', CertificadoController::class)->name('certificado.pdf');
    
});

