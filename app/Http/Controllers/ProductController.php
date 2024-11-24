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
    
        // Fetch the product with its images
        $product = Product::where('name', $productSlug)
            ->where('subcategory_id', $subcategory->id)
            ->with('productImages')
            ->firstOrFail();
    
        // Get the attributes for this specific product
        $productAttributes = Attribute::where('product_id', $product->id)->get();
    
        // Fetch only the sizes, colors, and types used by this product
        $sizes = Size::whereIn('id', $productAttributes->pluck('sizes')->flatten()->filter())
            ->orderBy('name')
            ->get();
    
        $colors = Color::whereIn('id', $productAttributes->pluck('colors')->flatten()->filter())
            ->orderBy('name')
            ->get();
    
        $types = Type::whereIn('id', $productAttributes->pluck('types')->flatten()->filter())
            ->orderBy('name')
            ->get();
    
        $qualities = Quality::whereIn('id', $productAttributes->pluck('qualities')->flatten()->filter())
            ->orderBy('name')
            ->get();
    
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

