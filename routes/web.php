<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
Use App\Http\Controllers\ArticulosController;
Use App\Http\Controllers\UsuarioController;
Use App\Http\Controllers\RegistroController;
Use App\Http\Controllers\GruposController;
Use App\Http\Controllers\CapacitacionesController;
Use App\Http\Controllers\RegistroShowController;
Use App\Http\Controllers\GruposShowController;
Use App\Http\Controllers\RegistroEditController;
Use App\Http\Controllers\DownloadController;
Use App\Http\Controllers\CertificadoController;
Use App\Http\Controllers\QrController;
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

Route::resource('/', ArticulosController::class);

Route::get('/articulos/{art}', [DownloadController::class, 'downloadART'])->name('downloadART');

Route::get('/registros/qr/{prop::uuid}', QrController::class)->name('qr.view');

Route::group(['middleware' => ['auth:sanctum', 'verified']], function(){

    Route::resource('/home', ArticulosController::class);

    /* Route::resource('/usuarios', UsuarioController::class); */

    Route::resource('/registros', RegistroController::class)->except('show','edit','update','destroy');

    Route::resource('/grupos', GruposController::class)->except('index', 'create', 'show', 'edit','destroy');

    Route::get('/capacitaciones', CapacitacionesController::class)->name('capacitaciones');

    Route::get('/capacitaciones/{grupo}', GruposShowController::class)->name('grupos.show');

    Route::get('/registros/{propietario}', RegistroShowController::class)->name('registros.show');

    Route::get('/registros/{propietario}/editar', RegistroEditController::class)->name('registros.edit');

    Route::match(['put', 'patch', 'post'], '/registros/{propietario}', [RegistroEditController::class, 'update'])->name('registros.update');

    Route::get('/memos/{memo}', [DownloadController::class, 'downloadMemo'])->name('downloadMemo');

    Route::get('/identificaciones/{doc}', [DownloadController::class, 'downloadDoc'])->name('downloadDoc');

    Route::get('/boletas/{boleta}', [DownloadController::class, 'downloadBol'])->name('downloadBol');

    Route::get('/antecedentes/{ant}', [DownloadController::class, 'downloadAntecedente'])->name('downloadAntecedente');

    Route::get('/seguros/{seguro}', [DownloadController::class, 'downloadSeguro'])->name('downloadSeguro');

    Route::get('/veterinaria/{vet}', [DownloadController::class, 'downloadVet'])->name('downloadVet');

    Route::get('/registros/{propietario}/pdf', CertificadoController::class)->name('certificado.pdf');

    /*Route::get('/qr_generator', [QrController::class, 'qr_generator'])->name('qr_generator');*/
});

