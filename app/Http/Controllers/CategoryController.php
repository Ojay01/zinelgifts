<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Show products under a category
    public function show($id)
    {
        $category = ProductCategory::with('subcategories')->findOrFail($id);
        // For simplicity, assume each category has associated products
        // You may need to implement a Product model and relationships
        $products = $category->products()->paginate(10); 

        return view('category.show', compact('category', 'products'));
    }

    // Show products under a subcategory
    public function showSubcategory($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        // Assuming the subcategory also has associated products
        $products = $subcategory->products()->paginate(10);

        return view('category.subcategory', compact('subcategory', 'products'));
    }
}
