<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'value'];

    public function productColors()
    {
        return $this->hasMany(ProductColor::class);
    }
    
    // You can keep the existing products relationship or modify it
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_color')
                    ->withPivot('stock')
                    ->withTimestamps();
    }
}
