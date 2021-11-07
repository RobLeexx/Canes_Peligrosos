<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Use App\Http\Controllers\UsuarioController;
Use App\Http\Controllers\ListaController;
Use App\Http\Controllers\RegistroController;

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
    
    Route::middleware(['auth:sanctum', 'verified'])->get('/home', function () {
        return Inertia::render('home');
    })->name('home');
    
    Route::middleware(['auth:sanctum', 'verified'])->get('/requisitos', function () {
        return Inertia::render('requisitos');
    })->name('requisitos');
    
    Route::middleware(['auth:sanctum', 'verified'])->get('/capacitaciones', function () {
        return Inertia::render('capacitaciones');
    })->name('capacitaciones');

    Route::middleware(['auth:sanctum', 'verified'])->get('/lista', function () {
        return Inertia::render('lista');
    })->name('lsta');
    
    Route::middleware(['auth:sanctum', 'verified'])->get('/Welcome', function () {
        return Inertia::render('Welcome');
    })->name('Welcome');
    
    Route::middleware(['auth:sanctum', 'verified'])->get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios');

    Route::middleware(['auth:sanctum', 'verified'])->get('/lista', [ListaController::class, 'listaCont'])->name('lista');
    
    Route::resource('memorials', RegistroController::class)->middleware(['auth:sanctum', 'verified']);
});

