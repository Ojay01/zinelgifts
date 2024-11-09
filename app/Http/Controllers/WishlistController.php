<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    /**
     * Display the user's wishlist.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get the authenticated user's wishlist with product relationships
        $wishlistItems = Wishlist::with('product')
            ->where('user_id', auth()->id())
            ->get();

        return view('wishlist', compact('wishlistItems'));
    }

    /**
     * Remove a product from the wishlist.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove($id)
    {
        Wishlist::where('user_id', auth()->id())
            ->where('id', $id)
            ->delete();

        return redirect()->back()->with('success', 'Item removed from wishlist');
    }

    public function removeProduct($id)
    {
        Wishlist::where('user_id', auth()->id())
            ->where('product_id', $id)
            ->delete();

        return redirect()->back()->with('success', 'Item removed from wishlist');
    }

    /**
     * Add a product to the wishlist.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add($id)
    {
        // Check if the product is already in the wishlist
        $exists = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $id) // Check if product_id matches the provided id
            ->exists();
    
        if (!$exists) {
            Wishlist::create([
                'user_id' => auth()->id(),
                'product_id' => $id,
            ]);
            $message = 'Product added to wishlist';
            
            // Pass success message
            return redirect()->back()->with('success', $message);
        } else {
            $errorMessage = 'Product is already in wishlist';
            
            // Pass error message
            return redirect()->back()->withErrors(['error' => $errorMessage]);
        }
    }
    
}