<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email_address',
        'department',
        'position',
        'contact_number',
        'signature',
        'status',
        'branch_id',
    ];

    public function fullname()
    {
        return $this->last_name . ', ' . $this->first_name;
    }
    public function branch()
    {
        return $this->belongsTo(branch::class, 'branch_id');
    }
}
