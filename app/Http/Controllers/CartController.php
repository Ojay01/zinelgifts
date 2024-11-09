<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function add(Product $product)
    {
        $user = auth()->user();
        
        // Check if product already exists in user's cart
        $cartItem = Cart::where('user_id', $user->id)
                       ->where('product_id', $product->id)
                       ->first();
        
        if ($cartItem) {
            // If product exists, increment quantity
            $cartItem->increment('quantity');
        } else {
            // If product doesn't exist, create new cart item
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => 1
            ]);
        }
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