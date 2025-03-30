<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'size_id', 'quality_id', 'price'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function quality()
    {
        return $this->belongsTo(Quality::class);
    }
}
