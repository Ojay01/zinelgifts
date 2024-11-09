<!-- resources/views/wishlist.blade.php -->
<x-guest-layout>
    <x-header />
    <div class="bg-gray-100 dark:bg-gray-900 py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold mb-12 text-gray-800 dark:text-white text-center">Your Wishlist</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($wishlistItems as $item)
                    <div class="group bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-lg transition-all duration-300 hover:shadow-2xl flex flex-col h-full">
                        <div class="relative aspect-w-1 aspect-h-1 overflow-hidden">
                            <img src="{{ asset('storage/' . $item->product->image) }}" 
                                 alt="{{ $item->product->name }}" 
                                 class="w-full h-80 object-cover transition-transform duration-300 group-hover:scale-110">
                            <div class="absolute inset-0 bg-black bg-opacity-20 group-hover:bg-opacity-50 transition-opacity duration-300"></div>
                            @if($item->product->discount)
                                <div class="absolute top-4 left-4 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full shadow-md">
                                    -{{ $item->product->discount }}%
                                </div>
                            @endif
                            <div class="absolute bottom-4 left-4 right-4 flex justify-between items-end opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <form action="{{ route('cart.add', $item->product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded-full shadow-lg transition-all duration-300 transform hover:scale-110 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <div class="p-4 flex-grow flex flex-col justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-1 truncate">
                                    {{ $item->product->name }}
                                </h3>
                                <p class="text-gray-600 dark:text-gray-300 text-sm mb-2">
                                    {{ $item->product->category->name }}
                                </p>
                                <a href="{{ route('details', [$item->product->category->name, $item->product->subcategory->name, $item->product->name]) }}" class="cursor-pointer">
                                <p class="text-gray-700 dark:text-gray-300 text-sm mb-3 line-clamp-2">
                                    {{ $item->product->description }}
                                </p></a>
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-xl font-bold text-yellow-500 dark:text-yellow-400">
                                        ₣{{ number_format($item->product->discounted_price, 2) }}
                                    </span>
                                    @if($item->product->discount)
                                        <span class="text-sm text-gray-500 line-through">
                                            ₣{{ number_format($item->product->price, 2) }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <div class="flex text-yellow-400">
                                        {!! str_repeat('<i class="fas fa-star text-xs"></i>', 5) !!}
                                    </div>
                                    <span class="text-gray-600 dark:text-gray-400 text-xs ml-1">
                                        ({{ $item->product->reviews_count ?? 0 }})
                                    </span>
                                </div>
                                <form action="{{ route('wishlist.remove', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            class="text-red-500 hover:text-red-600 transition-colors duration-300" 
                                            title="Remove from Wishlist">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 justify-center text-center py-12">
                        <p class="text-gray-600 dark:text-gray-400 mb-4">Your wishlist is empty.</p>
                        <a href="{{ route('shop')}}" 
                           class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-md transition-colors duration-300 inline-block">
                            Continue Shopping
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <x-footer />
</x-guest-layout>