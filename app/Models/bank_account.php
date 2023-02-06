<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bank_account extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'branch_id',
        'account_name',
        'account_number',
    ];

    public function branch()
    {
        return $this->belongsTo(branch::class, 'branch_id');
    }
}
