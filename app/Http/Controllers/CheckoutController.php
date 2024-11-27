<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Address;
use App\Models\Size;
use App\Models\Quality;
use App\Models\Type;
use App\Models\Color;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use MeSomb\Operation\PaymentOperation;
use MeSomb\Util\RandomGenerator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $addresses = Address::where('user_id', $user->id)->get();
    
        $cartItems = Cart::with(['product' => function($query) {
            $query->with(['category', 'subcategory']);
        }])
        ->where('user_id', $user->id)
        ->get()
        ->map(function ($item) {
            // Safely handle attributes
            $attributes = is_string($item->attributes) 
                ? json_decode($item->attributes, true) 
                : (array)$item->attributes;
            
            // Fetch related color, size, and quality details
            $color = !empty($attributes['color_id']) 
                ? Color::find($attributes['color_id']) 
                : null;
            
            $size = !empty($attributes['size_id']) 
                ? Size::find($attributes['size_id']) 
                : null;
            
            $quality = !empty($attributes['quality_id']) 
                ? Quality::find($attributes['quality_id']) 
                : null;
            
            $type = !empty($attributes['type_id']) 
                ? Type::find($attributes['type_id']) 
                : null;
            
            // Calculate product subtotal
            $price = $item->product->discounted_price ?? $item->product->price;
            $productSubtotal = $price * $item->quantity;
            
            return (object) [
                'id' => $item->id,
                'name' => $item->product->name,
                'description' => $item->product->description,
                'price' => $price,
                'original_price' => $item->product->price,
                'quantity' => $item->quantity,
                'product_subtotal' => $productSubtotal, // New field for product-specific subtotal
                'short_note' => $item->short_note,
                'image_url' => asset('storage/' . $item->product->image),
                'category' => $item->product->category->name,
                'subcategory' => $item->product->subcategory->name,
                'discount' => $item->product->discount,
                
                // Include detailed attribute information
                'attributes' => (object) [
                    'color' => $color ? (object)[
                        'id' => $color->id,
                        'name' => $color->name
                    ] : null,
                    'size' => $size ? (object)[
                        'id' => $size->id,
                        'name' => $size->name
                    ] : null,
                    'quality' => $quality ? (object)[
                        'id' => $quality->id,
                        'name' => $quality->name
                    ] : null,
                    'type' => $type ? (object)[
                        'id' => $type->id,
                        'name' => $type->name
                    ] : null
                ]
            ];
        });
        
        // Calculate subtotal using the new product_subtotal field
        $subtotal = $cartItems->sum('product_subtotal');
        
        $shippingCost = $subtotal > 100 ? 0 : 10;
        $total = $subtotal + $shippingCost;
        
        return view('checkout', compact('cartItems', 'subtotal', 'shippingCost', 'total', 'addresses'));
    }

    public function placeOrder(Request $request)
    {
        $user = auth()->user();
    
        // Validate request
        $validatedData = $request->validate([
            'selected_address' => 'required|exists:addresses,id',
            'payment_method' => 'required|in:om,momo,bank_transfer',
            'om_number' => 'required_if:payment_method,om|nullable|regex:/^[0-9]{9}$/',
            'momo_number' => 'required_if:payment_method,momo|nullable|regex:/^[0-9]{9}$/',
            'card_number' => 'required_if:payment_method,bank_transfer|nullable|digits:16',
            'expiry_date' => 'required_if:payment_method,bank_transfer|nullable|date_format:m/y',
            'cvv' => 'required_if:payment_method,bank_transfer|nullable|digits:3',
        ]);
    
        try {
            // Set dynamic service based on payment method
            $service = $validatedData['payment_method'] === 'om' ? 'ORANGE' : 'MTN';
            $payer = $validatedData['payment_method'] === 'om' ? $validatedData['om_number'] : $validatedData['momo_number'];
    
            // Start database transaction
            DB::beginTransaction();
    
            // Get cart items
            $cartItems = Cart::where('user_id', $user->id)->get();
    
            // Calculate order totals
            $subtotal = $cartItems->sum(function ($item) {
                $price = $item->product->discounted_price ?? $item->product->price;
                return $price * $item->quantity;
            });
    
            $shippingCost = $subtotal > 100 ? 0 : 10;
            $total = $subtotal + $shippingCost; // Total = Subtotal + Shipping Cost
    

    
            // API Call for payment
            $apiKey = "#";
            $accessKey = "#";
            $secretKey = "#";
    
            $client = new PaymentOperation($apiKey, $accessKey, $secretKey);
    
            // Make payment using dynamic service and payer
            $payment = $client->makeCollect([
                'amount' => 10, // Use dynamically calculated total
                'service' => $service,
                'payer' => $payer,
                'nonce' => RandomGenerator::nonce(),
                'trxID' => Str::uuid()
            ]);
    
            if (!$payment->success) {
                return back()->with('error', 'Payment failed, please try again.');
            }

                        // Create Order
                        $order = Order::create([
                            'user_id' => $user->id,
                            'order_number' => $this->generateOrderNumber(),
                            'address_id' => $validatedData['selected_address'],
                            'subtotal' => $subtotal,
                            'shipping_cost' => $shippingCost,
                            'total' => $total,
                            'status' => 'Paid'
                        ]);
    
            // Create Payment record
            Payment::create([
                'trans_id' => Str::uuid(), // Example transaction ID
                'amount' => $total, // Total cost of the order
                'service' => $service,
                'order_id' => $order->id,
            ]);
    
            // Create Order Items
            foreach ($cartItems as $cartItem) {
                $price = $cartItem->product->discounted_price ?? $cartItem->product->price;
    
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $price,
                    'attributes' => $cartItem->attributes,
                    'short_note' => $cartItem->short_note,
                    'photo' => $cartItem->photo
                ]);
            }
    
            // Prepare order totals for email
            $orderTotals = [
                'cart_items' => $cartItems,
                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'total' => $total,
            ];
    
            // Send order confirmation email
            $this->sendOrderConfirmationEmail($order, $orderTotals);
    
            // Clear user's cart
            Cart::where('user_id', $user->id)->delete();
    
            // Commit transaction
            DB::commit();
    
            // Return success response
            return back()->with('success', 'Order placed successfully. Order Number: ' . $order->order_number);
    
        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();
    
            // Log error message
            Log::error('Order Processing Failed', ['error' => $e->getMessage()]);
    
            // Return error response
            return back()->with('error', 'Order processing failed: ' . $e->getMessage());
        }
    }
    
    // Generate unique order number
    private function generateOrderNumber()
    {
        do {
            $orderNumber = strtoupper(Str::random(12));
        } while (Order::where('order_number', $orderNumber)->exists());
    
        return $orderNumber;
    }
    
    private function sendOrderConfirmationEmail(Order $order, array $orderTotals)
    {
        Mail::to($order->user->email)->send(
            new OrderConfirmationMail(
                $order,
                $orderTotals['cart_items'],
                $orderTotals['subtotal'],
                $orderTotals['shipping_cost'],
                $orderTotals['total']
            )
        );
    }
    


}
