<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        return view('profile.tabs.wishlist');
    }

    public function addresses()
    {
        return view('profile.tabs.addresses');
    }

    public function settings()
    {
        return view('profile.tabs.settings');
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

    /**
     * Update the user's profile information.
     *
     * @param  \App\Http\Requests\UpdateProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
            'phone' => ['nullable', 'string', 'max:20'],
            'bio' => ['nullable', 'string', 'max:1000'],
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = Auth::user();
        
        $user->update([
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'phone' => $request->phone,
            'bio' => $request->bio,
        ]);

        return back()->with('success', 'Profile updated successfully!');
    }

    /**
     * Update the user's profile picture.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => ['required', 'image', 'max:2048'] // 2MB Max
        ]);

        $user = Auth::user();

        // Delete old profile picture if exists
        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        // Store new profile picture
        $path = $request->file('profile_picture')->store('profile-pictures', 'public');
        
        $user->update([
            'profile_picture' => $path
        ]);

        return back()->with('success', 'Profile picture updated successfully!');
    }

    /**
     * Update the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
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