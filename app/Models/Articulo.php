<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;
    protected $fillable = [
    'artLP',
    'fileLP',

    'artCB',
    'fileCB',

    'artSC',
    'fileSC',

    'artOR',
    'fileOR',

    'artSU',
    'fileSU',

    'artPT',
    'filePT',
    ];
}
