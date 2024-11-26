<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display the user's profile page.
     *
     * @return \Illuminate\View\View
     */

     public function index()
     {
         // Get the authenticated user's wishlist with product relationships
      
 
         return view('profile.index');
     }


    public function information()
    {
        return view('profile.tabs.information');
    }

    public function orders()
    {
        return view('profile.tabs.orders');
    }

    public function wishlist()
    {
        $user = Auth::user();
        $wishlistProducts = $user->wishlist;
        return view('profile.tabs.wishlist', compact('wishlistProducts'));
    }

    public function addresses()
    {
        $addresses = Auth::user()->addresses;
        return view('profile.tabs.addresses', compact('addresses'));
    }

    public function settings()
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
                'image_url' =>  $item->product->image,
                'category' => $item->product->category->name,
                'subcategory' => $item->product->subcategory->name,
                'discount' => $item->product->discount
            ];
        });
        
        return view('profile.tabs.settings', compact('cartItems'));
    }
    public function show()
    {
        $user = Auth::user();
        // Get recent orders for the user
        $recentOrders = $user->orders()
            ->with('orderItems')
            ->latest()
            ->take(5)
            ->get();

        return view('profile.show', compact('user', 'recentOrders'));
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
            'number' => ['nullable', 'string', 'max:20'],
            'bio' => ['nullable', 'string', 'max:1000'],
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = Auth::user();
        
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'bio' => $request->bio,
        ]);

        return back()->with('success', 'Profile updated successfully!');
    }


    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => ['required', 'image', 'max:2048'] // 2MB Max
        ]);

        $user = Auth::user();

        // Delete old profile picture if exists
        if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        // Store new profile picture
        $path = $request->file('profile_picture')->store('profile-pictures', 'public');
        
        $user->update([
            'profile_photo_path' => $path
        ]);

        return back()->with('success', 'Profile picture updated successfully!');
    }


    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'The provided password does not match your current password.',
            ]);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Password updated successfully!');
    }

    /**
     * Get user's order history.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function orderHistory(Request $request)
    {
        $orders = Auth::user()
            ->orders()
            ->with('orderItems.product')
            ->latest()
            ->paginate(10);

        return view('profile.orders', compact('orders'));
    }

    /**
     * Get user's wishlist.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
   

    /**
     * Toggle product in wishlist.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $productId
     * @return \Illuminate\Http\JsonResponse
     */

    /**
     * Get user's addresses.
     *
     * @return \Illuminate\View\View
     */
}