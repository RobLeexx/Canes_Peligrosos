<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguro extends Model
{
    use HasFactory;
    protected $fillable = [
    'nomAgencia',
    'ubiAgencia',
    'dateExpSeg',
    'dateLimSeg',
    'resAgencia',
    'resAgenciaNum',
    'seguroFile'
    ];
}
