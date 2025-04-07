<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Subcategory;
use App\Models\VariablePrice;
use App\Models\ProductCategory;
use App\Models\Color;
use App\Models\Size;
use App\Models\Type;
use App\Models\Quality;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class ProductsController 
{
    public function index(Request $request)
    {
        // Start with a base query
        $query = Product::with(['category']);
        
        // Apply search filter if provided
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%")
                  ->orWhereHas('category', function($subquery) use ($searchTerm) {
                      $subquery->where('name', 'like', "%{$searchTerm}%");
                  });
            });
        }
        
        // Apply category filter if provided
        if ($request->has('category') && !empty($request->category)) {
            $query->where('category_id', $request->category);
        }
        
        // Get statistics for dashboard cards
        $totalProducts = Product::count();
        $discountedProducts = Product::where('discount', '>', 0)->count();
        $categoriesCount = ProductCategory::count();
        $featuredProducts = Product::where('featured', true)->count();
        
        // Get all categories for filter dropdown
        $categories = ProductCategory::all();
        
        // Execute the query with pagination
        $products = $query->latest()->paginate(50);
        
        return view('admin.products.index', compact(
            'products', 
            'categories', 
            'totalProducts', 
            'discountedProducts', 
            'categoriesCount', 
            'featuredProducts'
        ));
    }

    public function updateStatus(Request $request, Product $product)
    {
        // Validate the request
        $request->validate([
            'status' => 'required|integer|in:1,0,3',
        ]);

        try {
            // Update the product status
            $product->status = $request->status;
            $product->save();

            // Prepare success message based on status
            $statusMessages = [
                1 => 'Product marked as Active.',
                0 => 'Product marked as Inactive.',
                3 => 'Product saved as Draft.',
            ];

            // Flash success message to session
            return redirect()->back()->with('success', $statusMessages[$request->status]);
        } catch (\Exception $e) {
            // Log the error
            Log::error('Failed to update product status: ' . $e->getMessage());
            
            // Flash error message to session
            return redirect()->back()->with('error', 'Failed to update product status.');
        }
    }

    public function toggleFeatured(Product $product)
{
    $product->featured = $product->featured ? 0 : 1;
    $product->save();

    return redirect()->back()->with('success', 'Product featured status updated.');
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
        $product->load(['attributes', 'category', 'subcategory', 'productImages']);
        
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
        'price' => 'required_without:variable|numeric|min:0',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
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
        'variable' => 'nullable|boolean',
        'pricing_data' => 'nullable|json',
    ]);

    try {
        DB::beginTransaction();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }
        
        // Create new product
        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $request->input('variable') ? 0 : $validated['price'],
            'discount' => $validated['discount'] ?? 0,
            'image' => $validated['image'],
            'category_id' => $validated['category_id'],
            'subcategory_id' => $validated['subcategory_id'],
            'variable' => $request->boolean('variable'),
        ]);
        
        // Create product attributes
        $attributesData = [
            'sizes' => $request->input('attributes.sizes', []),
            'colors' => $request->input('attributes.colors', []),
            'qualities' => $request->input('attributes.qualities', []),
            'types' => $request->input('attributes.types', []),
        ];
        
        // Add pricing data if variable pricing is enabled
        if ($request->boolean('variable') && $request->has('pricing_data')) {
            $attributesData['prices'] = $request->input('pricing_data');
        }
        
        $product->attributes()->create($attributesData);

        DB::commit();
        
        return redirect()
            ->route('products.index')
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

public function uploadImage(Request $request, Product $product)
{
    $request->validate([
        'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            // Store the image in the storage
            $path = $image->store('product_images', 'public');

            // Save the image path in the database
            $product->productImages()->create([
                'image' => $path,
            ]);
        }
    }

    return redirect()->back()->with('success', 'Images uploaded successfully!');
}

public function destroyProductImage(ProductImage $image)
{
    // Delete the image file from storage
    if (Storage::disk('public')->exists($image->image)) {
        Storage::disk('public')->delete($image->image);
    }
    

    // Delete the image record from the database
    // $image->delete();
    $image->forceDelete(); 

    return response()->json(['message' => 'Image deleted successfully.'], 200);
}
}
