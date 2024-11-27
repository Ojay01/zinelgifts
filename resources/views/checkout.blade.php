<x-guest-layout>
    <x-header />

    <div class="bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-900 dark:to-gray-800 py-16">
        <div class="container mx-auto px-4 max-w-6xl">
            <!-- Breadcrumb with Improved Styling -->
            <nav class="text-sm mb-8">
                <ol class="list-none p-0 inline-flex items-center">
                    <li class="flex items-center">
                        <a href="#" class="text-yellow-600 hover:text-yellow-700 transition-colors duration-300 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                            </svg>
                            Home
                        </a>
                        <svg class="w-4 h-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 320 512">
                            <path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/>
                        </svg>
                    </li>
                    <li class="text-gray-600 dark:text-gray-400">Checkout</li>
                </ol>
            </nav>

            <!-- Checkout Section with Soft Shadow -->
            <div class="flex flex-col lg:flex-row gap-12 bg-white dark:bg-gray-800 rounded-xl shadow-2xl overflow-hidden">
                <!-- Left Column: Billing and Shipping -->
                <div class="w-full lg:w-2/3 p-8">
                    <!-- Shipping Address Section -->
                    <div class="mb-10">
                        <h2 class="text-3xl font-extrabold mb-6 text-gray-800 dark:text-white border-b-2 border-yellow-500 pb-3">
                            Shipping Address
                        </h2>
                        <form action="{{route('placeOrder')}}" method="POST">
                            @csrf
                        @if($addresses->count() > 0)
                            <div class="space-y-4">
                                @foreach($addresses as $address)
                                    <label class="block border-2 border-transparent rounded-lg p-4 hover:border-yellow-500 hover:bg-yellow-50 dark:hover:bg-gray-700 cursor-pointer transition-all duration-300 ease-in-out">
                                        <input type="radio" name="selected_address" value="{{ $address->id }}" required class="mr-3 text-yellow-500 focus:ring-yellow-500">
                                        <span class="font-medium text-gray-700 dark:text-gray-300">
                                            {{ $address->city }}, {{ $address->neighborhood }} 
                                            ({{ $address->number }})
                                        </span>
                                    </label>
                                @endforeach
                                
                                <button type="button" onclick="showAddAddressModal()" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-4 rounded-lg mt-4 transition-colors duration-300 flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    <span>Add New Address</span>
                                </button>
                            </div>
                        @else
                            <div class="text-center bg-gray-100 dark:bg-gray-700 p-8 rounded-lg">
                                <p class="text-gray-600 dark:text-gray-300 mb-6">
                                    You don't have any saved addresses yet.
                                </p>
                                <button type="button" onclick="showAddAddressModal()" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-6 rounded-lg transition-colors duration-300 flex items-center justify-center space-x-2 mx-auto">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    <span>Add Address</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <!-- Coupon Section (New) -->
                    <div class="mb-10">
                        <h2 class="text-3xl font-extrabold mb-6 text-gray-800 dark:text-white border-b-2 border-yellow-500 pb-3">
                            Coupon
                        </h2>
                        <div class="flex space-x-4">
                            <input 
                                type="text" 
                                id="coupon_code" 
                                placeholder="Enter coupon code" 
                                class="flex-grow px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            >
                            <button 
                                onclick="applyCoupon()" 
                                class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-6 rounded-lg transition-colors duration-300"
                            >
                                Apply
                            </button>
                        </div>
                        <p id="coupon-message" class="mt-2 text-sm text-gray-600 dark:text-gray-400"></p>
                    </div>

                    <!-- Payment Information Form -->
               
                        <!-- Payment Method Section -->
                        <h2 class="text-3xl font-extrabold mt-10 mb-6 text-gray-800 dark:text-white border-b-2 border-yellow-500 pb-3">
                            Payment Information
                        </h2>

                        <div class="mb-6">
                            <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-4">Select Payment Method</label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <label class="border-2 border-gray-200 dark:border-gray-700 rounded-lg p-4 flex items-center justify-center hover:border-yellow-500 transition-colors duration-300 cursor-pointer">
                                    <input type="radio" name="payment_method" value="momo" class="sr-only" required>
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 mb-2 text-yellow-300" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/>
                                        </svg>
                                        <span class="text-gray-800 dark:text-white">MTN Mobile Money</span>
                                    </div>
                                </label>
                                <label class="border-2 border-gray-200 dark:border-gray-700 rounded-lg p-4 flex items-center justify-center hover:border-yellow-500 transition-colors duration-300 cursor-pointer">
                                    <input type="radio" name="payment_method" value="om" class="sr-only" required>
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 mb-2 text-orange-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm1-13h-2v6h2zm0 8h-2v2h2z"/>
                                        </svg>
                                        <span class="text-gray-800 dark:text-white">Orange Money</span>
                                    </div>
                                </label>
                                <label class="border-2 border-gray-200 dark:border-gray-700 rounded-lg p-4 flex items-center justify-center hover:border-yellow-500 transition-colors duration-300 cursor-pointer">
                                    <input type="radio" name="payment_method" value="stripe" class="sr-only" required>
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 mb-2 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M19.92 12.54A5.98 5.98 0 0 0 12 8H8V4h8V2H8c-1.1 0-2 .9-2 2v4H4v2h2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2v-2h2v-2h-2v-2h2v-2h-2c-.18-1.96-1.06-3.64-2.46-4.46zM16 18H8V12h8a3 3 0 0 1 0 6z"/>
                                        </svg>
                                        <span class="text-gray-800 dark:text-white">Bank Card</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Payment Method Specific Fields -->
                        <div id="momo" class="hidden">
                            <div class="mb-6">
                                <label for="phone_number" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Momo Number</label>
                                <input type="number" id="phone_number" name="momo_number" placeholder="Enter MTN Mobile Money Number" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            </div>
                        </div>
                        <div id="om" class="hidden">
                            <div class="mb-6">
                                <label for="phone_number" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">OM Number</label>
                                <input type="number" id="phone_number" name="om_number" placeholder="Enter Orange Money Number" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            </div>
                        </div>
                        <div id="stripe" class="hidden">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="mb-6">
                                    <label for="card_number" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Card Number</label>
                                    <input type="text" id="card_number" name="card_number" placeholder="1234 1234 1234 1234" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                </div>
                                <div class="mb-6">
                                    <label for="expiry_date" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Expiry Date</label>
                                    <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                </div>
                                <div class="mb-6">
                                    <label for="cvv" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">CVV</label>
                                    <input type="text" id="cvv" name="cvv" placeholder="123" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-4 px-4 rounded-lg mt-6 transition-colors duration-300 transform hover:scale-105 flex items-center justify-center space-x-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                            </svg>
                            <span>Complete Purchase</span>
                        </button>
                   
                </div> </form>

                <!-- Right Column: Order Summary -->
                <div class="w-full lg:w-1/3 bg-gray-100 dark:bg-gray-900 p-8">
                    <div class="sticky top-8">
                        <h2 class="text-3xl font-extrabold mb-6 text-gray-800 dark:text-white border-b-2 border-yellow-500 pb-3">
                            Order Summary
                        </h2>

                        <!-- Order Items -->
                        <div class="space-y-4 mb-6">
                            @foreach($cartItems as $item)
                                <div class="flex items-center justify-between bg-white dark:bg-gray-800 p-4 rounded-lg shadow-sm">
                                    <div class="flex items-center space-x-4">
                                        <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="w-16 h-16 object-cover rounded-md">
                                        <div>
                                            <p class="font-semibold text-gray-800 dark:text-white">{{ $item->name }}</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Qty: {{ $item->quantity }}</p>
                                        </div>
                                    </div>
                                    <p class="font-bold text-gray-800 dark:text-white">₣{{ number_format($item->product_subtotal, 2) }}</p>
                                </div>
                            @endforeach
                        </div>

                        <!-- Cost Breakdown -->
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 space-y-4">
                            <div class="flex justify-between items-center">
                                <p class="text-gray-600 dark:text-gray-400">Subtotal</p>
                                <p class="text-gray-800 dark:text-white font-bold">₣{{ number_format($subtotal, 2) }}</p>
                            </div>
                            <div class="flex justify-between items-center">
                                <p class="text-gray-600 dark:text-gray-400">Shipping</p>
                                <p class="text-gray-800 dark:text-white font-bold">₣{{ number_format($shippingCost, 2) }}</p>
                            </div>
                            <div id="coupon-discount" class="hidden justify-between items-center text-green-600">
                                <p>Coupon Discount</p>
                                <p id="coupon-amount" class="font-bold"></p>
                            </div>
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                <div class="flex justify-between items-center">
                                    <p class="text-xl font-bold text-gray-800 dark:text-white">Total</p>
                                    <p id="total-amount" class="text-xl font-bold text-yellow-500 dark:text-yellow-400">₣{{ number_format($total, 2) }}</p>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Address Modal (From Previous Implementation) -->

        <div 
            id="addAddressModal" 
            class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50"
        >
            <div class="bg-white dark:bg-gray-800 rounded-lg p-8 w-full max-w-md shadow-2xl transform transition-all duration-300 ease-in-out scale-95 hover:scale-100">
                <div class="flex items-center mb-6">
                    <i class="fas fa-map-marker-alt text-yellow-500 mr-3 text-2xl"></i>
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-yellow-500">Add New Address</h3>
                </div>
                <form id="add-address-form" action="{{ route('addresses.store') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div class="relative">
                            <label class="block text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-city mr-2 text-gray-500"></i>City
                            </label>
                            <div class="relative">
                                <i class="fas fa-circle-info absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input 
                                    type="text" 
                                    name="city" 
                                    class="w-full pl-10 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    required
                                    placeholder="Enter city name"
                                >
                            </div>
                        </div>
                        <div class="relative">
                            <label class="block text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-home mr-2 text-gray-500"></i>Neighborhood
                            </label>
                            <div class="relative">
                                <i class="fas fa-location-dot absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input 
                                    type="text" 
                                    name="neighborhood" 
                                    class="w-full pl-10 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    required
                                    placeholder="Enter neighborhood"
                                >
                            </div>
                        </div>
                        <div class="relative">
                            <label class="block text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-hashtag mr-2 text-gray-500"></i>Number
                            </label>
                            <div class="relative">
                                <i class="fas fa-sort-numeric-up absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input 
                                    type="number" 
                                    name="number" 
                                    class="w-full pl-10 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    required
                                    placeholder="Address number"
                                >
                            </div>
                        </div>
                        <div class="relative">
                            <label class="block text-gray-700 dark:text-gray-300 mb-2">
                                <i class="fas fa-plus-circle mr-2 text-gray-500"></i>Complement (Optional)
                            </label>
                            <div class="relative">
                                <i class="fas fa-comment-dots absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                <input 
                                    type="text" 
                                    name="complement" 
                                    class="w-full pl-10 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                    placeholder="Additional address details"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end mt-6 space-x-4">
                        <button 
                            type="button" 
                            onclick="closeAddAddressModal()"
                            class="text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white flex items-center"
                        >
                            <i class="fas fa-times mr-2"></i>Cancel
                        </button>
                        <button 
                            type="submit" 
                            class="bg-yellow-500 text-white px-6 py-2 rounded-md hover:bg-yellow-600 transition duration-300 flex items-center"
                        >
                            <i class="fas fa-save mr-2"></i>Save Address
                        </button>
                    </div>
                </form>
            </div>
        </div>


    <x-footer />

    <script>
        // Existing payment method toggle script
        const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
        const momo = document.getElementById('momo');
        const om = document.getElementById('om');
        const stripe = document.getElementById('stripe');

        paymentMethods.forEach(method => {
            method.addEventListener('change', function() {
                if (this.value === 'momo') {
                    momo.classList.remove('hidden');
                    stripe.classList.add('hidden');
                    om.classList.add('hidden');
                } else if (this.value === 'stripe') {
                    stripe.classList.remove('hidden');
                    om.classList.add('hidden');
                    momo.classList.add('hidden');
                } else if (this.value === 'om') {
                    om.classList.remove('hidden');
                    stripe.classList.add('hidden');
                    momo.classList.add('hidden');
                }
            });
        });

        // Address Modal Functions
        function showAddAddressModal() {
            document.getElementById('addAddressModal').classList.remove('hidden');
            document.getElementById('addAddressModal').classList.add('flex');
        }

        function closeAddAddressModal() {
            document.getElementById('addAddressModal').classList.add('hidden');
            document.getElementById('addAddressModal').classList.remove('flex');
        }

        // Coupon Handling Script
        function applyCoupon() {
            const couponCode = document.getElementById('coupon_code').value;
            const couponMessage = document.getElementById('coupon-message');
            const couponDiscount = document.getElementById('coupon-discount');
            const couponAmount = document.getElementById('coupon-amount');
            const totalAmount = document.getElementById('total-amount');

            // Simulated coupon validation (replace with actual backend validation)
            const validCoupons = {
                'SAVE10': 0.1,  // 10% off
                'FIRST20': 0.2  // 20% off for first purchase
            };

            if (validCoupons[couponCode]) {
                const discountPercentage = validCoupons[couponCode];
                const originalTotal = {{ $subtotal }};
                const discountAmount = originalTotal * discountPercentage;
                const newTotal = originalTotal - discountAmount;

                couponMessage.textContent = `Coupon applied successfully!`;
                couponMessage.classList.remove('text-red-500');
                couponMessage.classList.add('text-green-500');

                couponDiscount.classList.remove('hidden');
                couponAmount.textContent = `-₣${discountAmount.toFixed(2)}`;
                totalAmount.textContent = `₣${newTotal.toFixed(2)}`;
            } else {
                couponMessage.textContent = 'Invalid coupon code';
                couponMessage.classList.remove('text-green-500');
                couponMessage.classList.add('text-red-500');
                couponDiscount.classList.add('hidden');
                totalAmount.textContent = `₣{{ number_format($subtotal, 2) }}`;
            }
        }
    </script>
</x-guest-layout>