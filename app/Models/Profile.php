<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'phone_number',
        'bio',
        'birth_date',
        'gender',
        'wallet',
        'default_billing_address',
        'default_shipping_address',
        'city',
        'region',
        'country',
        'newsletter_subscribed',
        'preferences'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'newsletter_subscribed' => 'boolean',
        'preferences' => 'array'
    ];

    protected $attributes = [
        'country' => 'Cameroon'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
