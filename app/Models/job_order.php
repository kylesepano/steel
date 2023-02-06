<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class job_order extends Model
{
    use HasFactory;
    protected $fillable = [
        'inquiry_product_id',
        'machine_id',
        'raw_material_id',
        'produced',
        'scrap_weight'
    ];

}
