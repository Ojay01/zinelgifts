<!-- resources/views/wishlist.blade.php -->
@php
    // Dummy wishlist data
    $wishlistItems = [
        (object)[
            'id' => 1,
            'name' => 'Product 1',
            'price' => 29.99,
            'image_url' => 'https://via.placeholder.com/150x150?text=Product+1',
        ],
        (object)[
            'id' => 2,
            'name' => 'Product 2',
            'price' => 49.99,
            'image_url' => 'https://via.placeholder.com/150x150?text=Product+2',
        ],
        (object)[
            'id' => 3,
            'name' => 'Product 3',
            'price' => 19.99,
            'image_url' => 'https://via.placeholder.com/150x150?text=Product+3',
        ],
        (object)[
            'id' => 4,
            'name' => 'Product 4',
            'price' => 99.99,
            'image_url' => 'https://via.placeholder.com/150x150?text=Product+4',
        ]
    ];
@endphp

<x-guest-layout>
    <x-header />

    <div class="bg-gray-100 dark:bg-gray-900 py-16">
        <div class="container mx-auto px-4">
            <!-- Page Title -->
            <h1 class="text-4xl font-bold mb-12 text-gray-800 dark:text-white text-center">Your Wishlist</h1>

            <!-- Wishlist Items -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($wishlistItems as $item)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                    <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-2">{{ $item->name }}</h2>
                        <p class="text-lg text-yellow-500 dark:text-yellow-400 font-semibold mb-4">₣{{ number_format($item->price, 2) }}</p>

                        <!-- Wishlist Item Actions -->
                        <div class="flex justify-between items-center">
                            <a href="{{ route('details', $item->id) }}" class="text-yellow-500 hover:text-yellow-600 font-semibold">View Product</a>

                            <form action="{{ route('wishlist.remove', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-red-500 hover:text-red-600 font-semibold">Remove</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- If Wishlist is Empty -->
            @if (count($wishlistItems) === 0)
            <div class="text-center py-12">
                <p class="text-gray-600 dark:text-gray-400">Your wishlist is empty.</p>
                <a href="/shop" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-md transition-colors duration-300 mt-4 inline-block">Continue Shopping</a>
            </div>
            @endif
        </div>
    </div>

    <x-footer />
</x-guest-layout>
