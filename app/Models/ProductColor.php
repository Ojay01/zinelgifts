<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'color_ids'
    ];

    // Cast the color_ids to array
    protected $casts = [
        'color_ids' => 'array'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function colors()
    {
        return Color::whereIn('id', $this->color_ids);
    }
}
