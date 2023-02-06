<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class user_credential extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'username',
        'password',
    ];

    public function user()
    {
        return $this->belongsTo(user::class, 'user_id');
    }
}
