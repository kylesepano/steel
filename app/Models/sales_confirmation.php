<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sales_confirmation extends Model
{
    use HasFactory;
    protected $fillable = [
        'inquiry_id',
        'sc_number',
    ];

    public function payments(){
        return $this->hasMany(payment::class,'sales_confirmation_id');
    }
}
