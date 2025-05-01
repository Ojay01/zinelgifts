<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\Color;
use App\Models\Size;
use App\Models\Type;
use App\Models\Quality;
use App\Models\Attribute;

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
    
        // Fetch the product with its images and attributes
        $product = Product::where('name', $productSlug)
            ->where('subcategory_id', $subcategory->id)
            ->with(['productImages', 'attributes'])
            // ->withCount('reviews')
            ->firstOrFail();
    
        // Ensure the product attributes are loaded
        $productAttributes = $product->attributes;
    
        // Fetch only the sizes, colors, types, and qualities used by this product
        $sizes = collect();
        $colors = collect();
        $types = collect();
        $qualities = collect();
    
        if ($productAttributes) {
            $sizes = Size::whereIn('id', $productAttributes->sizes ?? [])
                ->orderBy('name')
                ->get();
    
            $colors = Color::whereIn('id', $productAttributes->colors ?? [])
                ->orderBy('name')
                ->get();
    
            $types = Type::whereIn('id', $productAttributes->types ?? [])
                ->orderBy('name')
                ->get();
    
            $qualities = Quality::whereIn('id', $productAttributes->qualities ?? [])
                ->orderBy('name')
                ->get();
        }
    
        // Fetch related products
        $relatedProducts = Product::where('subcategory_id', $subcategory->id)
            ->where('id', '!=', $product->id)
            ->with(['productImages'])
            ->limit(4)
            ->get();
    
        return view('details', compact(
            'product',
            'category',
            'subcategory',
            'relatedProducts',
            'sizes',
            'colors',
            'types',
            'qualities'
        ));
    }

    public function shop(Request $request)
    {
        // Fetch categories for filter options
        $categories = ProductCategory::with('subcategories')->get();
        $user = $request->user();  // Fetch authenticated user
        
        // Initialize query builder for products
        $query = Product::query();
        $query->where('status', 1);
        
        // Eager load the attributes relationship for variant prices
        $query->with('attributes');
        
        // Apply category filter
        if ($request->has('category')) {
            $query->whereIn('category_id', $request->category);
        }
        
        // Apply subcategory filter
        if ($request->has('subcategory')) {
            $query->whereIn('subcategory_id', $request->subcategory);
        }
        
        // Apply price filter - note: this only filters on base price, not variant prices
        // For more complex filtering, you may need a custom query
        if ($request->filled('price_min') && $request->filled('price_max')) {
            $query->whereBetween('price', [$request->price_min, $request->price_max]);
        } elseif ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        } elseif ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }
        
        // Paginate the results
        $products = $query->paginate(9);
        
        // If user is authenticated, retrieve wishlist items
        $wishlist = $user && $user->wishlist ? $user->wishlist->pluck('id')->toArray() : [];
        
        return view('shop', compact('products', 'categories', 'wishlist'));
    }
    

}

