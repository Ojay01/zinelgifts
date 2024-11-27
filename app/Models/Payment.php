<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'trans_id', 'amount', 'service', 'is_successful'];

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
