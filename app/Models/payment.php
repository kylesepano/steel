<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'sales_confirmation_id',
        'date_received',
        'amount_paid',
        'remaining_payable',
        'mode',
        'bank_id',
        'bank',
        'check_number'
    ];
    public function mode_payment()
    {
        if ($this->mode == 1) {
            return "Cash";
        } elseif ($this->mode == 2) {
            return "Bank";
        } else {
            return "Check";
        }
    }
}
