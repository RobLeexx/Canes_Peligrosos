<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antecedente extends Model
{
    use HasFactory;
    protected $fillable = [
        'numCanes',
        'aFechaHoraCanes',
        'aCanesFile',
        'aCanes',

        'numRejap',
        'aFechaHoraRejap',
        'aRejapFile',
        'aRejap',

        'numFelcc',
        'aFechaHoraFelcc',
        'aFelccFile',
        'aFelcc',

        'numFelcn',
        'aFechaHoraFelcn',
        'aFelcnFile',
        'aFelcn',

        'numFelcv',
        'aFechaHoraFelcv',
        'aFelcvFile',
        'aFelcv',
    ];
}
