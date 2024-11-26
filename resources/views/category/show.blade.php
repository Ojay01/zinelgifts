<x-guest-layout>
    <x-header />

    <div class="bg-gray-100 dark:bg-gray-900 py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl text-center font-bold text-gray-800 dark:text-white mb-4">{{ $category->name }} </h1>
            <div class="w-24 h-1 bg-yellow-500 mx-auto mb-12"></div>

            <!-- Subcategories -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                @foreach ($category->subcategories as $subcategory)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                        <a href="{{ route('subcategory.show', $subcategory->id) }}" class="dark:text-yellow-500 hover:underline hover:text-yellow-500">
                            <h2 class="text-2xl font-bold mb-2">{{ $subcategory->name }}</h2>
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($products as $product)
                <div class="group bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-lg transition-all duration-300 hover:shadow-2xl flex flex-col h-full">
                    <div class="relative aspect-w-1 aspect-h-1 overflow-hidden">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                             class="w-full h-full max-h-80 object-cover transition-transform duration-300 group-hover:scale-110">
                        <div class="absolute inset-0 bg-black bg-opacity-20 group-hover:bg-opacity-50 transition-opacity duration-300"></div>
                        @if ($product->discount)
                            <div class="absolute top-4 left-4 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full shadow-md">
                                -{{ $product->discount }}%
                            </div>
                        @endif
                        <div class="absolute bottom-4 left-4 right-4 flex justify-between items-end opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                            <button class="bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded-full shadow-lg transition-all duration-300 transform hover:scale-110 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                            </form>
                        </div>
                    </div>
                    <div class="p-4 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-1 truncate">{{ $product->name }}</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-2">{{ $category->name }}</p>
                            <p class="text-gray-700 dark:text-gray-300 text-sm mb-3 line-clamp-2">{{ $product->description }}</p>
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-xl font-bold text-yellow-500 dark:text-yellow-400">
                                    ₣{{ number_format($product->discounted_price, 2) }}
                                </span>
                                @if ($product->discount)
                                    <span class="text-sm text-gray-500 line-through">
                                        ₣{{ number_format($product->price, 2) }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <div class="flex text-yellow-400">
                                    {!! str_repeat('<i class="fas fa-star text-xs"></i>', 5) !!}
                                </div>
                                <span class="text-gray-600 dark:text-gray-400 text-xs ml-1">({{ $product->reviews ?? 0 }})</span>
                            </div>
                            <form 
                            action="{{ in_array($product->id, $wishlist) ? route('wishlist.removeProduct', $product->id) : route('wishlist.add', $product->id) }}" 
                            method="POST" 
                            class="inline">
                            @csrf
                            <button class="text-red-500 hover:text-gray-500 transition-colors duration-300" title="{{ in_array($product->id, $wishlist) ? 'Remove from Wishlist' : 'Add to Wishlist' }}">
                                <i class="{{ in_array($product->id, $wishlist) ? 'fas' : 'far' }} fa-heart"></i>
                            </button>
                        </form>
                        </div>
                        <a href="{{ route('details', [$product->category->name, $product->subcategory->name, $product->name]) }}" class="text-yellow-500 text-end hover:underline mt-2 block">
                            View Product
                        </a>
                        
                    </div>
                </div>
                
                @empty
                    <p class="text-gray-500 text-center dark:text-gray-400">No products found in this category.</p>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $products->links() }}
            </div>
        </div>
    </div>

    <x-footer />
</x-guest-layout>
