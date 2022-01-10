<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propietario extends Model
{
    use HasFactory;
    protected $fillable = [
        'paterno',
        'materno',
        'nombres',
        'dateProp',
        'estCivil',
        'profesion',
        'docTipo',
        'documento',
        'docExp',
        'docFile',
        'fotoProp',
        'departamento',
        'provincia',
        'municipio',
        'zona',
        'domicilio',
        'latitud',
        'longitud',
        'celular',
        'telefono',
        'email',
        'contactoAlterno',
        'cac'
    ];
}
