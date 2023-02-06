<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'length_dependent',
        'purlin',
        'standard_length',
        'special_cut',
        'production_process',
        'bended_accessory',
        'uom',
        'color',
        'machine_id',
        
    ];

    public function machine()
    {
        return $this->belongsTo(machine::class, 'machine_id');
    }

    public function price()
    {
        return product_price::where('product_id', $this->id)->where('start_date', '<=', date('Y-m-d'))->where('end_date', '>=', date('Y-m-d'))->orderBy('start_date', 'asc')->first();
    }
}
