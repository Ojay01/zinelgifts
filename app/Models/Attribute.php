<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'sizes', 'colors', 'qualities', 'types', 'prices', 'variable_type'];
    
    protected $casts = [
        'sizes' => 'array',
        'colors' => 'array',
        'qualities' => 'array',
        'types' => 'array',
        'prices' => 'array'
    ];
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
