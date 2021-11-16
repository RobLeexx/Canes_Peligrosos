<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Can extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomPerro',
        'fotoCan',
        'fotoCan2',
        'razaCan'
    ];
}
