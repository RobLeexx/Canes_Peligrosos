<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capacitacion extends Model
{
    use HasFactory;
    protected $fillable = [
        'capacitador',
        'observaciones',
        'tipoCap',
        'grupoID',
        'estado',
        'asistenciaCompleta',
    ];
}
