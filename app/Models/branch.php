<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class branch extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    public function bank_accounts()
    {
        return $this->hasMany(bank_account::class, 'branch_id');
    }
}
