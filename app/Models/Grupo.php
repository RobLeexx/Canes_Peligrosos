<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;
    protected $fillable = [
        'capacitador',
        'integrantes',
        'tipo',
        'turno',
        'horario',
        'inicio',
        'fin',
        'completos',
        'incompletos',
        'observados',
        'estado',
    ];
}
