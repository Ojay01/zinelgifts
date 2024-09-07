<!-- resources/views/cart.blade.php -->
@php
    // Simulate cart items using random data
    $faker = \Faker\Factory::create();
    $cartItems = [];
    for ($i = 0; $i < 5; $i++) {
        $cartItems[] = (object)[
            'id' => $i + 1,
            'name' => $faker->word . ' Product',
            'description' => $faker->sentence,
            'price' => $faker->randomFloat(2, 10, 100),
            'quantity' => $faker->numberBetween(1, 5),
            'image_url' => 'https://via.placeholder.com/100x100?text=' . urlencode('Product ' . ($i + 1))
        ];
    }

    // Calculate totals
    $subtotal = array_reduce($cartItems, function ($carry, $item) {
        return $carry + ($item->price * $item->quantity);
    }, 0);
    $shippingCost = $subtotal > 100 ? 0 : 10; // Free shipping over 100₣
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
                        <a href="#" class="hover:text-yellow-500">Cart</a>
                    </li>
                </ol>
            </nav>

            <!-- Cart Section -->
            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Cart Items -->
                <div class="w-full lg:w-3/4">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Shopping Cart</h2>

                    <!-- Cart Item -->
                    @foreach ($cartItems as $item)
                    <div class="border-b border-gray-200 dark:border-gray-700 py-6 flex flex-col sm:flex-row sm:items-start justify-between space-y-4 sm:space-y-0">
                        <div class="flex items-center">
                            <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="w-24 h-24 object-cover rounded-lg shadow-lg">
                            <div class="ml-4 w-64 lg:w-80">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $item->name }}</h3>
                                <p class="text-gray-600 dark:text-gray-400">{{ $item->description }}</p>
                                <p class="text-yellow-500 dark:text-yellow-400 font-bold mt-1">₣{{ number_format($item->price, 2) }}</p>
                            </div>
                        </div>

                        <!-- Quantity and Total Price -->
                        <div class="flex items-center space-x-4">
                            <label for="quantity-{{ $item->id }}" class="sr-only">Quantity</label>
                            <input type="number" id="quantity-{{ $item->id }}" name="quantity" min="1" value="{{ $item->quantity }}" class="w-16 px-3 py-2 border hidden lg:block border-gray-300 rounded-md text-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                            <p class="text-xl font-bold text-gray-800 dark:text-white">₣{{ number_format($item->quantity * $item->price, 2) }}</p>
                        </div>

                        <!-- Remove Item Button -->
                        <button class="text-red-500 hover:text-red-600 transition-colors duration-300">
                            <i class="fas fa-trash-alt"></i> Remove
                        </button>
                    </div>
                    @endforeach
                </div>

                <!-- Order Summary -->
                <div class="w-full lg:w-1/4 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
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
                    <a href="{{ route('checkout') }}" class="block bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-4 rounded-md text-center mt-6 transition-colors duration-300">Proceed to Checkout</a>
                </div>
            </div>
        </div>
    </div>

    <x-footer />
</x-guest-layout>
