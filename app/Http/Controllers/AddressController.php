<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'city' => 'required|string|max:255',
            'neighborhood' => 'required|string|max:255',
            'number' => 'required|string|max:50',
            'complement' => 'nullable|string|max:255'
        ]);

        $address = Auth::user()->addresses()->create($validatedData);

        return redirect()->back()
            ->with('success', 'Address added successfully');
    }

    public function destroy(Address $address)
    {
        // Check if the address is associated with any orders
        if ($address->orders()->exists()) {
            return redirect()->back()
                ->with('error', 'Address cannot be deleted because it is associated with an order.');
        }
    
        // Proceed to delete the address
        $address->delete();
    
        return redirect()->back()
            ->with('success', 'Address deleted successfully.');
    }
    
}