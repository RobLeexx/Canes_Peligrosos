<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Use App\Http\Controllers\UsuarioController;

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
    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    
    Route::middleware(['auth:sanctum', 'verified'])->get('/home', function () {
        return Inertia::render('home');
    })->name('home');
    
    Route::middleware(['auth:sanctum', 'verified'])->get('/one', function () {
        return Inertia::render('one');
    })->name('one');
    
    Route::middleware(['auth:sanctum', 'verified'])->get('/two', function () {
        return Inertia::render('two');
    })->name('two');
    
    Route::middleware(['auth:sanctum', 'verified'])->get('/Welcome', function () {
        return Inertia::render('Welcome');
    })->name('Welcome');
    
    Route::middleware(['auth:sanctum', 'verified'])->get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios');
});