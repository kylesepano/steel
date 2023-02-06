<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class raw_material extends Model
{
    use HasFactory;
    protected $fillable = [
        'raw_material',
        'coil_type',
        'bl_number',
        'j_code',
        'l_code',
        'width',
        'thickness',
        'beginning_weight',
        'beginning_length',
        'type',
        'color',
    ];

    public function raw_material_notes(){
        return $this->hasMany(raw_material_note::class,'raw_material_id');
    }
}
