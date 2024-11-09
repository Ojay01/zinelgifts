<?php
namespace App\Http\Controllers;
use App\Models\Slide;
use App\Models\ProductCategory;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch all slides from the database
        $slides = Slide::all();
        
        // Fetch product categories with their product count
        $categories = ProductCategory::withCount('products')
            ->limit(4)  // Limit to 4 categories
            ->get()
            ->map(function ($category) {
                // Get the first product's image as the category image
                $firstProduct = $category->products()->first();
                $imageUrl = $firstProduct ? $firstProduct->image_url : 'https://via.placeholder.com/400x300';  // Use a placeholder if no product image

                return [
                    'name' => $category->name,
                    'image' => $category->image,
                    'description' => $category->description,
                    'products' => $category->products_count,
                    'link' => route('category.show', $category->id),  // Assuming you have a route for showing categories
                ];
            });

            $products = Product::latest()
            ->take(8)
            ->get();
        
        // Pass the slides and categories data to the 'welcome' view
        return view('welcome', compact('slides', 'categories', 'products'));
    }
}