<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Storage;

class CategoryController 
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

public function subcat(ProductCategory $category)
    {
        $subcategories = $category->subcategories()->paginate(10);
        return view('admin.category.subcat', compact('category', 'subcategories'));
    }

    public function updateSubCat(Request $request, ProductCategory $category, Subcategory $subcategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500'
        ]);

        $subcategory->update($validated);

        return redirect()->back()
            ->with('success', 'Subcategory updated successfully');
    }

    public function storeSubCat(Request $request, ProductCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $category->subcategories()->create($validated);

        return redirect()->back()
            ->with('success', 'Subcategory created successfully');
    }

    public function destroySubCat(ProductCategory $category, Subcategory $subcategory)
    {
        $subcategory->delete();

        return redirect()->back()
            ->with('success', 'Subcategory deleted successfully');
    }
}
