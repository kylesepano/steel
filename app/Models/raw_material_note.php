<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class raw_material_note extends Model
{
    use HasFactory;
    protected $fillable = [
        'raw_material_id',
        'notes',
    ];
}
