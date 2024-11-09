<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'image', 'category_id', 'subcategory_id', 'discount'];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function getDiscountedPriceAttribute()
    {
        // If discount is available, calculate the discounted price
        if ($this->discount) {
            return round($this->price - ($this->price * ($this->discount / 100)), 2);
        }

        // Otherwise, return the original price
        return $this->price;
    }

    public function productColor()
    {
        return $this->hasOne(ProductColor::class);
    }
    
    public function colors()
    {
        return $this->hasManyThrough(
            Color::class,
            ProductColor::class,
            'product_id',
            'id',
            'id',
            'color_ids'
        );
    }

    public function productImages()
{
    return $this->hasMany(ProductImage::class);
}
}
