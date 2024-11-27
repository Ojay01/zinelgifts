<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class OrderItem extends Model
{
    use HasFactory;

    protected $casts = [
        'attributes' => 'array', // This works when storing JSON
    ];
    
    protected $fillable = ['order_id', 'product_id', 'attributes', 'quantity', 'short_note', 'photo'];

    public $incrementing = false; // Disable auto-increment
    protected $keyType = 'string'; // Specify that the primary key is a string

    protected static function boot()
    {
        parent::boot();

        // Generate UUID when creating a new model
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }
}
