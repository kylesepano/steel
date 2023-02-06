<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inquiry_product extends Model
{
    use HasFactory;
    protected $fillable = [
        'inquiry_id',
        'product_id',
        'product_variation_id',
        'length',
        'color',
        'quantity',
        'price_piece',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(product::class, 'product_id');
    }
    public function product_variation()
    {
        return $this->belongsTo(product_variation::class, 'product_variation_id');
    }

    public function remaining()
    {
        $remaining = $this->quantity;
        $produced = job_order::where('inquiry_product_id', $this->id)->get();
        foreach ($produced as $p) {
            $remaining -= $p->produced;
        }

        return $remaining;
    }
}
