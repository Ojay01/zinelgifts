<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'order_number', 'status', 'address_id'];

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

    // In the Order model
public function user()
{
    return $this->belongsTo(User::class);
}

}
