<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memorial extends Model
{
    use HasFactory;
    protected $fillable = [
        'comandante',
        'referencia',
        'dateMemo',
        /*'file_memo'*/
    ];
}
