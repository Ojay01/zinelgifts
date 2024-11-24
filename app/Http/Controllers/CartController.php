<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function add(Request $request, Product $product)
    {
        $user = auth()->user();
        
        // Validate the request input
        $validated = $request->validate([
            'attributes.size_id' => 'nullable|integer|exists:sizes,id',
            'attributes.quality_id' => 'nullable|integer|exists:qualities,id',
            'attributes.type_id' => 'nullable|integer|exists:types,id',
            'attributes.color_id' => 'nullable|integer|exists:colors,id',
            'short_note' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5048', // Validate photo
        ]);
        
        // Extract attributes, short_note, and photo
        $attributes = $validated['attributes'] ?? [];
        $shortNote = $validated['short_note'] ?? null;
        $photo = $request->file('photo');  // Handle the photo upload
    
        // Initialize the photo path as null
        $photoPath = null;
    
        // If a photo is uploaded, store it in the 'carts' folder
        if ($photo) {
            $photoPath = $photo->store('carts', 'public'); // Store the photo in the 'carts' folder
        }
        
        // Check if the product already exists in the user's cart
        $cartItem = Cart::where('user_id', $user->id)
                        ->where('product_id', $product->id)
                        ->first();
        
        if ($cartItem) {
            // If product exists, increment quantity and update attributes, note, and photo
            $cartItem->increment('quantity');
            $cartItem->update([
                'attributes' => $attributes,
                'short_note' => $shortNote,
                'photo' => $photoPath,  // Update the photo if uploaded
            ]);
        } else {
            // If product doesn't exist, create a new cart item
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => 1,
                'attributes' => $attributes,
                'short_note' => $shortNote,
                'photo' => $photoPath,  // Store the photo in the 'carts' folder when creating a new cart item
            ]);
        }
        
        // Remove product from wishlist if it exists
        Wishlist::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->delete();
        
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    
    

    

    public function index()
    {
        $user = auth()->user();
        
        // Get cart items with product relationship
        $cartItems = Cart::with(['product' => function($query) {
            $query->with(['category', 'subcategory']);
        }])
        ->where('user_id', $user->id)
        ->get()
        ->map(function ($item) {
            return (object) [
                'id' => $item->id,
                'name' => $item->product->name,
                'description' => $item->product->description,
                'price' => $item->product->discounted_price ?? $item->product->price,
                'original_price' => $item->product->price,
                'quantity' => $item->quantity,
                'image_url' => asset('storage/' . $item->product->image),
                'category' => $item->product->category->name,
                'subcategory' => $item->product->subcategory->name,
                'discount' => $item->product->discount
            ];
        });

        // Calculate totals
        $subtotal = $cartItems->sum(function($item) {
            return $item->price * $item->quantity;
        });
        
        // Calculate shipping cost (example logic)
        $shippingCost = $subtotal > 100 ? 0 : 10;
        
        // Calculate total
        $total = $subtotal + $shippingCost;

        return view('cart', compact('cartItems', 'subtotal', 'shippingCost', 'total'));
    }

    public function updateQuantity(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = Cart::findOrFail($id);
        $cartItem->update(['quantity' => $request->quantity]);

        return response()->json([
            'success' => true,
            'message' => 'Quantity updated successfully'
        ]);
    }

    public function remove($id)
    {
        Cart::findOrFail($id)->delete();
        return back()->with('success', 'Item removed from cart successfully');
    }


}