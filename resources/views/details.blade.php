<x-guest-layout>
    <x-header />

    <div class="bg-gray-100 dark:bg-gray-900 py-16">
        <div class="container mx-auto px-4">
            <!-- Breadcrumb -->
            <nav class="text-sm mb-6">
                <ol class="list-none p-0 inline-flex">
                    <li class="flex items-center text-gray-600 dark:text-gray-400">
                        <a href="{{ url('/') }}" class="hover:text-yellow-500">Home</a>
                        <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                    </li>
                    <li class="flex items-center text-gray-600 dark:text-gray-400">
                        <a href="{{ route('category.show', $product->category->id) }}" class="hover:text-yellow-500">{{ $product->category->name }}</a>
                        <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                    </li>
                    <li class="flex items-center text-yellow-500">{{ $product->subcategory->name }}</li>
                </ol>
            </nav>

            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Product Images -->
                <div class="w-full lg:w-1/2">
                    <div class="relative mb-4">
                        <div class="overflow-hidden" id="image-zoom-container">
                            <img id="main-image" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full max-h-[450px] rounded-lg shadow-lg transition-transform duration-300 transform scale-100">
                        </div>
                    </div>

                    <!-- Thumbnails -->
                    <div class="flex gap-2 justify-center" id="thumbnails">
                        <img src="{{ asset('storage/' . $product->image) }}" id="original-image" alt="Product Image" class="thumbnail w-12 h-12 md:w-20 md:h-20 rounded-lg shadow cursor-pointer border-2 border-transparent hover:opacity-75 transition-opacity duration-300" onclick="changeMainImage(this, this.src)">
                        @if(!empty($product->additional_images) && is_array($product->additional_images))
                        @foreach($product->additional_images as $image)
                            <img src="{{ asset('storage/' . $image) }}" alt="Additional Product Image" class="thumbnail w-12 h-12 md:w-20 md:h-20 rounded-lg shadow cursor-pointer border-2 border-transparent hover:opacity-75 transition-opacity duration-300" onclick="changeMainImage(this, this.src)">
                        @endforeach
                    @endif
                    
                    </div>
                </div>

                <!-- Product Details -->
                <div class="w-full lg:w-1/2">
                    <h1 class="text-3xl font-bold mb-4 text-gray-800 dark:text-white">{{ $product->name }}</h1>
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400 mr-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                        </div>
                        <span class="text-gray-600 dark:text-gray-400">({{ $product->reviews_count ?? 0 }} reviews)</span>
                    </div>
                    <p class="text-2xl font-bold text-yellow-500 dark:text-yellow-400 mb-4">
                        ₣{{ number_format($product->discounted_price, 2) }} 
                        @if ($product->discount > 0)
                            <span class="text-sm text-gray-500 line-through ml-2">₣{{ number_format($product->price, 2) }}</span>
                        @endif
                    </p>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Color
                        </label>
                        <div class="flex flex-wrap gap-3">
                            @if($colors->isNotEmpty())
                                @foreach($colors as $color)
                                    <div class="relative">
                                        <input 
                                            type="radio" 
                                            name="color" 
                                            id="color-{{ $color->id }}" 
                                            value="{{ $color->id }}" 
                                            class="sr-only peer"
                                            @if($loop->first) checked @endif
                                        >
                                        <label 
                                            for="color-{{ $color->id }}" 
                                            class="block w-9 h-9 rounded-full cursor-pointer border border-gray-300 dark:border-gray-600 relative group"
                                            style="background-color: {{ $color->value }};"
                                        >
                                            <span class="sr-only">{{ $color->name }}</span>
                    
                                            <!-- Border when selected -->
                                            <div class=" inset-0 rounded-full border-2 border-transparent peer-checked:border-green-500 transition duration-200"></div>
                    
                                            <!-- Checkmark for selected color -->
                                            {{-- <span class=" inset-0 hidden peer-checked:flex items-center justify-center">
                                                <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </span> --}}
                    
                                            <!-- Tooltip for color name -->
                                            <span class=" -bottom-8 left-1/2 transform -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-200 text-sm text-gray-600 dark:text-gray-400 whitespace-nowrap">
                                                {{ ucfirst($color->name) }}
                                            </span>
                                        </label>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-gray-500 dark:text-gray-400">No colors available for this product</p>
                            @endif
                        </div>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300 mb-6">{!! Str::limit($product->description, 200) !!}</p>

  <!-- Size and Color selections here, same as your existing template -->
                    
                    <!-- Add to Cart Button -->
                    <div class="flex items-center mb-6">
                        <div class="mr-4">
                            <label for="quantity" class="sr-only">Quantity</label>
                            <input type="number" id="quantity" name="quantity" min="1" value="1" class="w-16 px-3 py-2 border border-gray-300 rounded-md text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        </div>
                        <button class="flex-grow bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-md transition-colors duration-300">
                            Add to Cart
                        </button>
                    </div>

                    <!-- Product Meta Information -->
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                        <p class="text-gray-600 dark:text-gray-400 mb-2">
                            <span class="font-semibold text-gray-700 dark:text-gray-300">Category:</span> {{ $product->category->name }}
                        </p>
                        <p class="text-gray-600 dark:text-gray-400 mb-2">
                            <span class="font-semibold text-gray-700 dark:text-gray-300">Tags:</span> 
                            {{ is_array($product->tags) ? implode(', ', $product->tags) : $product->tags }}
                        </p>                        
                        <p class="text-gray-600 dark:text-gray-400">
                            <span class="font-semibold text-gray-700 dark:text-gray-300">SKU:</span> 
                        </p>
                    </div>
                </div>
            </div>

            <!-- Product Information Tabs -->
            <div class="mt-16">
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <nav class="-mb-px flex space-x-8">
                        <a href="#" class="border-yellow-500 text-yellow-500 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" onclick="showTab('description')">
                            Description
                        </a>
                        <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" onclick="showTab('additional-info')">
                            Additional Information
                        </a>
                        <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" onclick="showTab('reviews')">
                            Reviews
                        </a>
                    </nav>
                </div>

                <!-- Tab Content -->
                <div id="description" class="py-6">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Product Description</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">{!! $product->description !!}</p>
                    <!-- Add more product details as necessary -->
                </div>

                <!-- Additional Info and Reviews tabs remain the same -->
            </div>

            <!-- Related Products Section -->
            <div class="mt-16">
                <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Related Products</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $relatedProduct)
                        <div class="group bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-lg transition-all duration-300 hover:shadow-2xl flex flex-col h-full">
                            <div class="relative aspect-w-1 aspect-h-1 overflow-hidden">
                                <img src="{{ asset('storage/' . $relatedProduct->image) }}" alt="{{ $relatedProduct->name }}" class="w-full h-full max-h-80 object-cover transition-transform duration-300 group-hover:scale-110">
                                <div class="absolute inset-0 bg-black bg-opacity-20 group-hover:bg-opacity-50 transition-opacity duration-300"></div>
                                @if ($relatedProduct->discount)
                                <div class="absolute top-4 left-4 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full shadow-md">
                                    -{{ $relatedProduct->discount }}%
                                </div>
                            @endif
                                <div class="absolute bottom-4 left-4 right-4 flex justify-between items-end opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <button class="bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded-full shadow-lg transition-all duration-300 transform hover:scale-110 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="p-4 flex-grow flex flex-col justify-between">
                                <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-1 truncate">{{ $relatedProduct->name }}</h3>
                                <p class="text-gray-600 dark:text-gray-300 text-sm mb-2">{{ $relatedProduct->category->name }}</p>
                                <p class="text-gray-700 dark:text-gray-300 text-sm mb-3 line-clamp-2">{{ $relatedProduct->description }}</p>
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-xl font-bold text-yellow-500 dark:text-yellow-400">₣{{ number_format($relatedProduct->discounted_price, 2) }}</span>
                                    @if ($relatedProduct->discount)
                                    <span class="text-sm line-through  text-gray-500">₣{{ number_format($relatedProduct->price, 2) }}</span>
                                    @endif
                                </div>
                                <div class="flex justify-between items-center">
                                    <button class="text-gray-400 hover:text-red-500 transition-colors duration-300" title="Add to Wishlist">
                                        <i class="far fa-heart"></i>
                                    </button>
                                    <a href="{{ route('details', [$relatedProduct->category->name, $relatedProduct->subcategory->name, $relatedProduct->name]) }}" class="text-yellow-500 text-end hover:underline mt-2 block">
                                        View Product
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <x-footer />

    <script>
        // Keep the image zoom and tab switching JS the same
    </script>
</x-guest-layout>
