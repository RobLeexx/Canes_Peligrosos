<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        'boleta',
        'cac',
        'grupo',
        'creado_por',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

}
