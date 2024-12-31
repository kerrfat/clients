<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'company',
        'notes',
    ];

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
    public function uscisCases()
{
    return $this->hasMany(UscisCase::class);
}
}
