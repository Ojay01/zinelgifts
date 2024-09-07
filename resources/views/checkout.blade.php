<!-- resources/views/checkout.blade.php -->
@php
    // Manually defining the variables for testing or static purposes
    $subtotal = 150.00; // Example subtotal amount
    $shippingCost = $subtotal > 100 ? 0 : 10.00; // Free shipping if subtotal is above 100₣
    $total = $subtotal + $shippingCost;
@endphp

<x-guest-layout>
    <x-header />

    <div class="bg-gray-100 dark:bg-gray-900 py-16">
        <div class="container mx-auto px-4">
            <!-- Breadcrumb -->
            <nav class="text-sm mb-6">
                <ol class="list-none p-0 inline-flex">
                    <li class="flex items-center text-gray-600 dark:text-gray-400">
                        <a href="#" class="hover:text-yellow-500">Home</a>
                        <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                    </li>
                    <li class="flex items-center text-gray-600 dark:text-gray-400">
                        <a href="#" class="hover:text-yellow-500">Checkout</a>
                    </li>
                </ol>
            </nav>

            <!-- Checkout Section -->
            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Billing and Shipping Information -->
                <div class="w-full lg:w-2/3">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Billing & Shipping Information</h2>

                    <form action="/checkout/submit" method="POST">
                        @csrf

                        <!-- Personal Information -->
                        <div class="mb-6">
                            <label for="name" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Full Name</label>
                            <input type="text" id="name" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-md text-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
                        </div>

                        <div class="mb-6">
                            <label for="email" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Email Address</label>
                            <input type="email" id="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-md text-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
                        </div>

                        <div class="mb-6">
                            <label for="address" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Shipping Address</label>
                            <input type="text" id="address" name="address" class="w-full px-3 py-2 border border-gray-300 rounded-md text-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500" required>
                        </div>

                        <!-- Payment Information -->
                        <h2 class="text-2xl font-bold mt-10 mb-6 text-gray-800 dark:text-white">Payment Information</h2>

                        <div class="mb-6">
                            <label for="payment_method" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Select Payment Method</label>
                            <div class="flex flex-col space-y-3">
                                <label class="flex items-center">
                                    <input type="radio" name="payment_method" value="mtn_mobile_money" class="form-radio h-5 w-5 text-yellow-500 focus:ring-yellow-500" required>
                                    <span class="ml-3 text-gray-800 dark:text-white">MTN Mobile Money</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="payment_method" value="orange_mobile_money" class="form-radio h-5 w-5 text-yellow-500 focus:ring-yellow-500" required>
                                    <span class="ml-3 text-gray-800 dark:text-white">Orange Mobile Money</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="payment_method" value="stripe" class="form-radio h-5 w-5 text-yellow-500 focus:ring-yellow-500" required>
                                    <span class="ml-3 text-gray-800 dark:text-white">Bank Card (via Stripe)</span>
                                </label>
                            </div>
                        </div>

                        <!-- Conditional Payment Fields -->
                        <div id="mobile_money_fields" class="hidden">
                            <div class="mb-6">
                                <label for="phone_number" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Phone Number</label>
                                <input type="text" id="phone_number" name="phone_number" placeholder="Enter Mobile Money Phone Number" class="w-full px-3 py-2 border border-gray-300 rounded-md text-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            </div>
                        </div>

                        <div id="stripe_fields" class="hidden">
                            <div class="mb-6">
                                <label for="card_number" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Card Number</label>
                                <input type="text" id="card_number" name="card_number" placeholder="1234 1234 1234 1234" class="w-full px-3 py-2 border border-gray-300 rounded-md text-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            </div>
                            <div class="mb-6">
                                <label for="expiry_date" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Expiry Date</label>
                                <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY" class="w-full px-3 py-2 border border-gray-300 rounded-md text-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            </div>
                            <div class="mb-6">
                                <label for="cvv" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">CVV</label>
                                <input type="text" id="cvv" name="cvv" placeholder="123" class="w-full px-3 py-2 border border-gray-300 rounded-md text-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-4 rounded-md mt-6 transition-colors duration-300">
                            Complete Purchase
                        </button>
                    </form>
                </div>

                <!-- Order Summary -->
                <div class="w-full lg:w-1/3 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-bold mb-6 text-gray-800 dark:text-white">Order Summary</h2>
                    <div class="flex justify-between items-center mb-4">
                        <p class="text-gray-600 dark:text-gray-400">Subtotal</p>
                        <p class="text-gray-800 dark:text-white font-bold">₣{{ number_format($subtotal, 2) }}</p>
                    </div>
                    <div class="flex justify-between items-center mb-4">
                        <p class="text-gray-600 dark:text-gray-400">Shipping</p>
                        <p class="text-gray-800 dark:text-white font-bold">₣{{ number_format($shippingCost, 2) }}</p>
                    </div>
                    <div class="border-t border-gray-200 dark:border-gray-700 py-4">
                        <div class="flex justify-between items-center">
                            <p class="text-xl font-bold text-gray-800 dark:text-white">Total</p>
                            <p class="text-xl font-bold text-yellow-500 dark:text-yellow-400">₣{{ number_format($total, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-footer />

    <script>
        // Payment Method Toggle
        const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
        const mobileMoneyFields = document.getElementById('mobile_money_fields');
        const stripeFields = document.getElementById('stripe_fields');

        paymentMethods.forEach(method => {
            method.addEventListener('change', function() {
                if (this.value === 'mtn_mobile_money' || this.value === 'orange_mobile_money') {
                    mobileMoneyFields.classList.remove('hidden');
                    stripeFields.classList.add('hidden');
                } else if (this.value === 'stripe') {
                    stripeFields.classList.remove('hidden');
                    mobileMoneyFields.classList.add('hidden');
                }
            });
        });
    </script>
</x-guest-layout>
