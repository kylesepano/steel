<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class refprovince extends Model
{
    use HasFactory;
    protected $fillable = [
        'psgcCode',
        'provDesc',
        'regCode',
        'provCode',
    ];
}
