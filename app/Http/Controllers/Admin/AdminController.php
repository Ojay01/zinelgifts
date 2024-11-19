<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Storage;

class AdminController 
{
    
    public function categoryIndex()
    {
        $categories = ProductCategory::withCount('subcategories')->get();
        return view('admin.category.allcategory', compact('categories'));
    }

public function storeCategory(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|max:255|unique:product_categories',
        'description' => 'nullable|max:500',
        'image' => 'nullable|image|max:2048'
    ]);

    $category = new ProductCategory();
    $category->name = $validatedData['name'];
    $category->description = $validatedData['description'] ?? null;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('categories', 'public');
        $category->image = $imagePath;
    }

    $category->save();

    return redirect()->back()->with('success', 'Category created successfully');
}

public function updateCategory(Request $request, $id)
{
    $validatedData = $request->validate([
        'name' => 'required|max:255|unique:product_categories,name,'.$id,
        'description' => 'nullable|max:500',
        'image' => 'nullable|image|max:2048'
    ]);

    $category = ProductCategory::findOrFail($id);
    $category->name = $validatedData['name'];
    $category->description = $validatedData['description'] ?? null;

    if ($request->hasFile('image')) {
        // Remove old image if exists
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $imagePath = $request->file('image')->store('categories', 'public');
        $category->image = $imagePath;
    }

    $category->save();

    return redirect()->back()->with('success', 'Category updated successfully');
}

public function deleteCategory($id)
{
    $category = ProductCategory::findOrFail($id);

    // Optional: Delete associated image
    if ($category->image) {
        Storage::disk('public')->delete($category->image);
    }

    $category->delete();

    return redirect()->back()->with('success', 'Category deleted successfully');
}


public function createCategory()
{
    return view('admin.category.addCategory');
}

public function editCategory($id)
{
    $category = ProductCategory::findOrFail($id);
    return view('admin.category.edit', compact('category'));
}
}
