<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'user_id',
        'purpose',
        'branch_id',
        'discount_type',
        'discount_amount',
        'status',
        'notes',
        'job_order_id',
    ];

    public function customer()
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }
    public function qty_total()
    {
        return inquiry_product::where('inquiry_id', $this->id)->sum('quantity');
    }
    public function user()
    {
        return $this->belongsTo(user::class, 'user_id');
    }
    public function branch()
    {
        return $this->belongsTo(branch::class, 'branch_id');
    }
    public function inquiry_products()
    {
        return $this->hasMany(inquiry_product::class, 'inquiry_id');
    }
    public function discount()
    {
        $discount = 0;

        if ($this->discount_type != 0) {
            if ($this->discount_type != 3) {
                $discount = $this->total() * ($this->discount_amount / 100);
            } else {
                $discount = $this->discount_amount;
            }
        }

        return  $discount;
    }
    public function total()
    {
        $total = 0;

        foreach ($this->inquiry_products as $i) {
            $total += $i->price_piece * $i->quantity;
        }

        return  $total;
    }
    public function grand_total()
    {
        $grand_total = $this->total() - $this->discount();

        return  $grand_total;
    }
    public function sales_confirmations()
    {
        return $this->hasOne(sales_confirmation::class, 'inquiry_id');
    }
    public function remaining_due()
    {
        $total = $this->grand_total();
        if ($this->sales_confirmations != null) {
            foreach ($this->sales_confirmations->payments as $p) {
                $total -= $p->amount_paid;
            }
        }
        return $total;
    }
}
