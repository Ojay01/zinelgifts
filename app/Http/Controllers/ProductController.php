<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Subcategory;

class ProductController extends Controller
{
    public function show($categorySlug, $subcategorySlug, $productSlug)
    {
        // Fetch the category by slug
        $category = ProductCategory::where('name', $categorySlug)->firstOrFail();

        // Fetch the subcategory by slug and ensure it belongs to the category
        $subcategory = Subcategory::where('name', $subcategorySlug)
            ->where('category_id', $category->id)
            ->firstOrFail();

        // Fetch the product by slug and ensure it belongs to the subcategory
        $product = Product::where('name', $productSlug)
            ->where('subcategory_id', $subcategory->id)
            ->firstOrFail();

        // Fetch related products (same category or subcategory)
        $relatedProducts = Product::where('subcategory_id', $subcategory->id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('details', compact('product', 'category', 'subcategory', 'relatedProducts'));
    }
}

