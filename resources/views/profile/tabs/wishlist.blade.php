@extends('profile.index')

@section('profile-content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl overflow-hidden">
        <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 p-6">
            <h2 class="text-3xl font-bold text-white flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                </svg>
                My Wishlist
            </h2>
        </div>

        <div class="p-6">
            @if($wishlistProducts->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($wishlistProducts as $product)
                        <div class="group relative bg-gray-50 dark:bg-gray-800 rounded-xl overflow-hidden shadow-lg transition-all duration-300 hover:shadow-2xl hover:scale-105">
                            {{-- Discount Badge --}}
                            @if(isset($product->discount))
                                <div class="absolute top-4 right-4 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full z-10 transform -rotate-6 group-hover:scale-110 transition-transform">
                                    -{{ $product->discount }}%
                                </div>
                            @endif

                            <div class="relative overflow-hidden">
                                <img 
                                    {{-- src="{{ $product->image }}"  --}}
                                    src="{{ Storage::url($product->image)  }}" 
                                    alt="{{ $product->name }}" 
                                    class="w-full h-56 object-cover transition-transform duration-300 group-hover:scale-110"
                                >
                                <form action="{{route('wishlist.removeProduct', $product->id)}}" method="POST" class="absolute top-4 left-4 opacity-0 group-hover:opacity-100 transition-opacity">
                                    @csrf
                                    <button type="submit" class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition duration-300 shadow-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                            
                            <div class="p-4 space-y-3">
                                <h3 class="text-xl font-bold text-gray-800 dark:text-white truncate">{{ $product->name }}</h3>
                                
                                <div class="flex flex-col space-y-2">
                                    {{-- Pricing --}}
                                    @if(isset($product->discount) && $product->discount > 0)
                                        <div class="flex items-center justify-between">
                                            <span class="text-red-500 line-through text-sm">
                                                ₣{{ number_format($product->discounted_price, 2) }}
                                            </span>
                                            <span class="text-yellow-600 font-bold text-xl">
                                                ₣{{ number_format($product->price, 2) }}
                                            </span>
                                        </div>
                                    @else
                                        <span class="text-yellow-600 font-bold text-xl">
                                            ₣{{ number_format($product->price, 2) }}
                                        </span>
                                    @endif
                                    
                                    {{-- View Details Button --}}
                                    <a href="{{ route('details', [$product->category->name, $product->subcategory->name, $product->name]) }}" class="w-full text-center bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 transition duration-300 group-hover:shadow-lg">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16 bg-gray-50 dark:bg-gray-800 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 mx-auto text-gray-400 dark:text-gray-600 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <p class="text-xl text-gray-600 dark:text-gray-400 mb-6">Your wishlist feels a bit lonely</p>
                    <a href="{{ route('shop') }}" class="inline-block bg-yellow-500 text-white px-8 py-3 rounded-md hover:bg-yellow-600 transition duration-300 shadow-md">
                        Start Shopping
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection