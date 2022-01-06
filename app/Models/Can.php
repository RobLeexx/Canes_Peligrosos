<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Can extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomPerro',
        'dateNacPerro',
        'sexoCan',
        'procedenciaCan',
        'fotoCan',
        'fotoCan2',

        'pedigree',
        'razaCan',
        'tamCan',
        'colorCan',
        'sinCan',

        'vacuna',
        'dateVacPerro',
        'esterilizacion',
        'dateEstPerro',
        'mismoVeterinario',

        'vetNom1',
        'vetUbi1',
        'vetRes1',
        'vetNum1',
        'vacFile',

        'vetNom2',
        'vetUbi2',
        'vetRes2',
        'vetNum2',
        'estFile',

        'vetNom3',
        'vetUbi3',
        'vetRes3',
        'vetNum3',
        
        'numMicro',
        'canEven1',
        'canEvenNum1',
        'canEven2',
        'canEvenNum2',
        'canEven3',
        'canEvenNum3',
        'canEven4',
        'canEvenNum4',
        'canConvivencia',
    ];
}
