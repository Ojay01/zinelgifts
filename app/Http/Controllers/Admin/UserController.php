<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\Wishlist;
use App\Models\Cart;


class UserController 
{
    
    /**
     * Display a listing of users.
     */
    public function index()
    {
        $users = User::
            paginate(100);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Password::defaults()],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing the user.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the user.
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'password_confirmation' => ['required_with:password'],
        ];
    
        $validated = $request->validate($rules);
    
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);
    
        if ($validated['password']) {
            $user->update([
                'password' => Hash::make($validated['password']),
            ]);
        }
    
        return redirect()
            ->back()
            ->with('success', 'User updated successfully.');
    }

    /**
     * Delete the user.
     */
    public function destroy(User $user)
    {
        // Prevent self-deletion
        if ($user->id === auth()->id()) {
            return redirect()
                ->route('users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User deleted successfully.');
    }

    public function showProfile(User $user)
    {
        // Load necessary relationships
        $user->load(['profile', 'cart', 'wishlist']);
        
        // Add counts to the user model
        $user->loadCount(['cart', 'wishlist']);
        
        return view('admin.users.profile', [
            'user' => $user
        ]);
    }

    public function editProfile(User $user)
    {
     
        
        return view('admin.users.profile.edit', [
            'user' => $user
        ]);
    }

    public function userWishlist()
{
    $wishlists = Wishlist::with(['user', 'product'])
        ->orderBy('created_at', 'desc')
        ->paginate(10);
    
    return view('admin.wishlist.index', compact('wishlists'));
}

public function userCarts()
    {
        // Fetch all cart items, eager load the related user and product data
        $cartItems = Cart::with('user', 'product')->get();

        // Pass the cart items to the view
        return view('admin.carts.index', compact('cartItems'));
    }

public function destroyWishlist(Wishlist $wishlist)
    {
        try {
            $wishlist->delete();
            return redirect()
                ->back()
                ->with('success', 'Wishlist item removed successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Failed to remove wishlist item.');
        }
    }
}



