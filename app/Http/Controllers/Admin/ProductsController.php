<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Subcategory;
use App\Models\ProductCategory;
use App\Models\Color;
use App\Models\Size;
use App\Models\Type;
use App\Models\Quality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class ProductsController 
{
    public function index()
    {
        $products = Product::with(['category'])
            ->latest()
            ->paginate(50);
            
        return view('admin.products.index', compact('products'));
    }

    public function getSubcategories(ProductCategory $category)
    {
        return response()->json(
            $category->subcategories()
                    ->select('id', 'name')
                    ->get()
        );
    }
    public function edit(Product $product)
    {
        // Eager load relationships to reduce database queries
        $product->load(['attributes', 'category', 'subcategory']);
        
        // Get categories with subcategories
        $categories = ProductCategory::with('subcategories')->get();
        $subcategories = Subcategory::all();
        
        // Get all attribute options
        $sizes = Size::orderBy('name')->get();
        $colors = Color::orderBy('name')->get();
        $qualities = Quality::orderBy('name')->get();
        $types = Type::orderBy('name')->get();
        
        return view('admin.products.edit', compact(
            'product',
            'categories',
            'subcategories',
            'sizes',
            'colors',
            'qualities',
            'types'
        ));
    }
    
    public function update(Request $request, Product $product)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:product_categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'discount' => 'nullable|numeric|min:0|max:100',
            'attributes' => 'nullable|array',
            'attributes.sizes' => 'nullable|array',
            'attributes.sizes.*' => 'exists:sizes,id',
            'attributes.colors' => 'nullable|array',
            'attributes.colors.*' => 'exists:colors,id',
            'attributes.qualities' => 'nullable|array',
            'attributes.qualities.*' => 'exists:qualities,id',
            'attributes.types' => 'nullable|array',
            'attributes.types.*' => 'exists:types,id',
        ]);
    
        try {
            // DB::beginTransaction();
            
            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if it exists
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }
                
                // Store new image
                $imagePath = $request->file('image')->store('products', 'public');
                $validated['image'] = $imagePath;
            }
            
            // Update product details
            $product->update($validated);
            
            // Update or create product attributes
            $product->attributes()->updateOrCreate(
                ['product_id' => $product->id],
                [
                    'sizes' => $request->input('attributes.sizes', []),
                    'colors' => $request->input('attributes.colors', []),
                    'qualities' => $request->input('attributes.qualities', []),
                    'types' => $request->input('attributes.types', []),
                ]
            );
    
            // DB::commit();
            
            // Clear any relevant cache
            // Cache::tags(['products'])->flush();
            
            return redirect()
                ->back()
                ->with('success', 'Product updated successfully');
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            // Log the error
            Log::error('Product update failed: ' . $e->getMessage(), [
                'product_id' => $product->id,
                'user_id' => auth()->id(),
                'request_data' => $request->except(['image']),
            ]);
            
            // If image was uploaded but transaction failed, clean it up
            if (isset($imagePath) && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to update product. Please try again.');
        }
    }


    public function store(Request $request)
{
    // Validate the request
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Made required for new products
        'category_id' => 'required|exists:product_categories,id',
        'subcategory_id' => 'required|exists:subcategories,id',
        'discount' => 'nullable|numeric|min:0|max:100',
        'attributes' => 'nullable|array',
        'attributes.sizes' => 'nullable|array',
        'attributes.sizes.*' => 'exists:sizes,id',
        'attributes.colors' => 'nullable|array',
        'attributes.colors.*' => 'exists:colors,id',
        'attributes.qualities' => 'nullable|array',
        'attributes.qualities.*' => 'exists:qualities,id',
        'attributes.types' => 'nullable|array',
        'attributes.types.*' => 'exists:types,id',
    ]);

    try {
        // DB::beginTransaction();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }
        
        // Create new product
        $product = Product::create($validated);
        
        // Create product attributes
        $product->attributes()->create([
            'sizes' => $request->input('attributes.sizes', []),
            'colors' => $request->input('attributes.colors', []),
            'qualities' => $request->input('attributes.qualities', []),
            'types' => $request->input('attributes.types', []),
        ]);

        DB::commit();
        
        // Clear any relevant cache
        // Cache::tags(['products'])->flush();
        
        return redirect()
            ->route('products.index') // Adjust route as needed
            ->with('success', 'Product created successfully');
            
    } catch (\Exception $e) {
        DB::rollBack();
        
        // Log the error
        Log::error('Product creation failed: ' . $e->getMessage(), [
            'user_id' => auth()->id(),
            'request_data' => $request->except(['image']),
        ]);
        
        // If image was uploaded but transaction failed, clean it up
        if (isset($imagePath) && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
        
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Failed to create product. Please try again.');
    }
}
    

public function create()
{
    $categories = ProductCategory::all();
    $subcategories = Subcategory::all();
        
    // Get categories with subcategories
    $categories = ProductCategory::with('subcategories')->get();
    $subcategories = Subcategory::all();
    
    // Get all attribute options
    $sizes = Size::orderBy('name')->get();
    $colors = Color::orderBy('name')->get();
    $qualities = Quality::orderBy('name')->get();
    $types = Type::orderBy('name')->get();
    
    return view('admin.products.create', compact('categories', 'subcategories', 'sizes',
        'colors',
        'qualities',
        'types'));
}

}
