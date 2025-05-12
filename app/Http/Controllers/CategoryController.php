<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    // Show products under a category
    public function show($id)
    {
        $category = ProductCategory::with('subcategories')->findOrFail($id);
        $products = $category->products()->where('status', 1)->paginate(10); 

        $wishlist = [];
        if (Auth::check()) {
            $user = Auth::user();
            $wishlist = $user->wishlist ? $user->wishlist->pluck('id')->toArray() : [];
        }

        return view('category.show', compact('category', 'products', 'wishlist'));
    }

    // Show products under a subcategory
    public function showSubcategory($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $products = $subcategory->products()->where('status', 1)->paginate(10);


        $wishlist = [];
        if (Auth::check()) {
            $user = Auth::user();
            $wishlist = $user->wishlist ? $user->wishlist->pluck('id')->toArray() : [];
        }

        return view('category.subcategory', compact('subcategory', 'products', 'wishlist'));
    }
}
