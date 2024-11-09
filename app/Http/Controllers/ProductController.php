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
        ->with('productImages') // Eager load additional images
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
        $user = $request->user();  // Fetch authenticated user
    
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
        if ($request->filled('price_min') && $request->filled('price_max')) {
            $query->whereBetween('price', [$request->price_min, $request->price_max]);
        } elseif ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        } elseif ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }
    
        // Paginate the results and eager load wishlist items if user is authenticated
        $products = $query->paginate(9);
    
        // If user is authenticated, retrieve wishlist items to pass to the view
        // $wishlist = $user ? $user->wishlist->pluck('id')->toArray() : [];
        // Inside your controller method
$wishlist = $user && $user->wishlist ? $user->wishlist->pluck('id')->toArray() : [];

    
        return view('shop', compact('products', 'categories', 'wishlist'));
    }
    

}

