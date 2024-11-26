<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'city', 
        'neighborhood', 
        'number',
        'complement'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessor to format address display
    public function getFullAddressAttribute()
    {
        $address = "{$this->number} {$this->neighborhood}, {$this->city}";
        if ($this->complement) {
            $address .= " ({$this->complement})";
        }
        return $address;
    }
}