<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\Color;

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
    
        // Fetch colors based on the product's color IDs
        $colors = $product->productColor 
            ? Color::whereIn('id', $product->productColor->color_ids)->get()
            : collect(); // Use an empty collection if no colors are found
    
        return view('details', compact('product', 'category', 'subcategory', 'relatedProducts', 'colors'));
    }

    public function shop(Request $request)
    {
        // Fetch categories for filter options
        $categories = ProductCategory::with('subcategories')->get();

        // Initialize query builder for products
        $query = Product::query();

        // Apply category filter
        if ($request->has('category')) {
            $query->whereIn('category_id', $request->category);
        }

        // Apply subcategory filter
        if ($request->has('subcategory')) {
            $query->whereIn('subcategory_id', $request->subcategory);
        }

        // Apply price filter
        if ($request->has('price_min') && $request->has('price_max')) {
            // Both min and max price provided
            $query->whereBetween('price', [$request->price_min, $request->price_max]);
        } elseif ($request->has('price_min')) {
            // Only min price provided
            $query->where('price', '>=', $request->price_min);
        } elseif ($request->has('price_max')) {
            // Only max price provided
            $query->where('price', '<=', $request->price_max);
        }
        

        // Paginate the results
        $products = $query->paginate(9);

        return view('shop', compact('products', 'categories'));
    }

}

