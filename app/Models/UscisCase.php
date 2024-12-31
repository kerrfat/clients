<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UscisCase extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'case_number',
        'status',
        'last_status',
        
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
