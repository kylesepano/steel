<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_price extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'start_date',
        'end_date',
        'end_user',
        'dealer',
        'contractor',
        'branch_id',
        'additional_special_cut',

    ];

    public function product()
    {
        return $this->belongsTo(product::class, 'product_id');
    }
    public function branch()
    {
        return $this->belongsTo(branch::class, 'branch_id');
    }
}
