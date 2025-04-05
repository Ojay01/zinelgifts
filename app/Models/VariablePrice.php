<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VariablePrice extends Model
{
    protected $fillable = ['product_id', 'variants'];

    protected $casts = [
        'variants' => 'array',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
