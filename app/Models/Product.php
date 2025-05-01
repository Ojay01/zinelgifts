<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'image', 'category_id', 'subcategory_id', 'discount', 'variable', 'featured', 'status'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['discounted_price', 'original_price', 'has_variable_pricing'];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
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

    public function attributes()
    {
        return $this->hasOne(Attribute::class);
    }

    /**
     * Get the price attribute, including variant prices if available
     *
     * @param float $value
     * @return float
     */
    public function getPriceAttribute($value)
    {
        // Get the attribute relationship
        $attributeRelation = $this->attributes()->first();
        
        // If there are no variants or attributes, return the base price
        if (!$attributeRelation || empty($attributeRelation->prices)) {
            return (float)$value;
        }
        
        // Try to get prices from attributes
        $prices = json_decode($attributeRelation->prices, true);
        
        // If no valid prices array, return the base price
        if (!is_array($prices) || empty($prices)) {
            return (float)$value;
        }
        
        // Get the lowest price from variants as the base price
        $lowestPrice = null;
        foreach ($prices as $variant) {
            if (isset($variant['price']) && (is_null($lowestPrice) || $variant['price'] < $lowestPrice)) {
                $lowestPrice = (float)$variant['price'];
            }
        }
        
        return $lowestPrice ?? (float)$value;
    }

    /**
     * Get the discounted price attribute
     *
     * @return float
     */
    public function getDiscountedPriceAttribute()
    {
        // First, get the appropriate base price (which may be from variants)
        $basePrice = $this->getOriginalPriceAttribute();
        
        // Get the attribute relationship
        $attributeRelation = $this->attributes()->first();
        
        // If there are no variants or attributes, apply the product's discount
        if (!$attributeRelation || empty($attributeRelation->prices)) {
            return $this->calculateDiscount($basePrice, $this->discount);
        }
        
        // Try to get prices from attributes
        $prices = json_decode($attributeRelation->prices, true);
        
        // If no valid prices array, use standard discount calculation
        if (!is_array($prices) || empty($prices)) {
            return $this->calculateDiscount($basePrice, $this->discount);
        }
        
        // Find the lowest discounted price from all variants
        $lowestDiscountedPrice = null;
        
        foreach ($prices as $variant) {
            if (isset($variant['price'])) {
                $variantPrice = (float)$variant['price'];
                $variantDiscount = isset($variant['discount']) && $variant['discount'] > 0 
                    ? (float)$variant['discount'] 
                    : (float)$this->discount;
                
                $discountedPrice = $this->calculateDiscount($variantPrice, $variantDiscount);
                
                if (is_null($lowestDiscountedPrice) || $discountedPrice < $lowestDiscountedPrice) {
                    $lowestDiscountedPrice = $discountedPrice;
                }
            }
        }
        
        return $lowestDiscountedPrice ?? $this->calculateDiscount($basePrice, $this->discount);
    }

    /**
     * Get the original price for display (before discount)
     * 
     * @return float
     */
    public function getOriginalPriceAttribute()
    {
        // Get the raw price value from the database
        return (float)$this->getAttributeFromArray('price');
    }

    /**
     * Check if product has variable pricing
     *
     * @return bool
     */
    public function getHasVariablePricingAttribute()
    {
        $attributeRelation = $this->attributes()->first();
        
        if (!$attributeRelation || empty($attributeRelation->prices)) {
            return false;
        }
        
        $prices = json_decode($attributeRelation->prices, true);
        return is_array($prices) && count($prices) > 1;
    }

    /**
     * Helper method to calculate discounted price
     * 
     * @param float $price
     * @param float $discount
     * @return float
     */
    private function calculateDiscount($price, $discount)
    {
        if ($discount > 0) {
            return round($price * (1 - ($discount / 100)), 2);
        }
        return $price;
    }
}