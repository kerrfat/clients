<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
   // use HasFactory;

    protected $fillable = [
        'client_id',
        'full_name',
        'email_address',
        'email_password',
        'uscis_password',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
