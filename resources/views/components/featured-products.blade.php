
<section class="py-16 bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800" x-data="{ activeTab: 'special', activeSlide: 0 }">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-2 dark:text-yellow-500">Featured Products</h2>
        <div class="w-24 h-1 bg-yellow-500 mx-auto mb-4"></div>
        <p class="text-center text-gray-600 dark:text-gray-300 mb-8">Discover our handpicked selection of top-quality items</p>
        
        <div class="flex justify-center items-center mb-12">
            <div class="flex space-x-4 bg-white dark:bg-gray-800 rounded-full shadow-md p-1">
                <button @click="activeTab = 'special'" :class="{ 'bg-yellow-500 text-white': activeTab === 'special', 'text-gray-700 dark:text-gray-300': activeTab !== 'special' }" class="py-2 px-6 rounded-full transition-all duration-300 focus:outline-none">Special Offer</button>
                <button @click="activeTab = 'new'" :class="{ 'bg-yellow-500 text-white': activeTab === 'new', 'text-gray-700 dark:text-gray-300': activeTab !== 'new' }" class="py-2 px-6 rounded-full transition-all duration-300 focus:outline-none">New Arrivals</button>
                <button @click="activeTab = 'featured'" :class="{ 'bg-yellow-500 text-white': activeTab === 'featured', 'text-gray-700 dark:text-gray-300': activeTab !== 'featured' }" class="py-2 px-6 rounded-full transition-all duration-300 focus:outline-none">Featured</button>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Special Offer Slider -->
            <div class="md:col-span-1 relative h-[400px] rounded-lg overflow-hidden shadow-lg">
                @foreach($specialOffers as $index => $offer)
                    <div x-show="activeSlide === {{ $index }}" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $offer['image'] }}');">
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-end p-6 text-white">
                            <h3 class="text-2xl font-bold mb-2">{{ $offer['title'] }}</h3>
                            <p class="mb-4 text-sm">{{ $offer['subtitle'] }}</p>
                            <button class="bg-yellow-500 hover:bg-yellow-600 text-black py-2 px-4 rounded-full inline-block w-max transition-colors duration-300">View More</button>
                        </div>
                    </div>
                @endforeach
                <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
                    @foreach($specialOffers as $index => $offer)
                        <button @click="activeSlide = {{ $index }}" :class="{ 'bg-yellow-500': activeSlide === {{ $index }}, 'bg-white': activeSlide !== {{ $index }} }" class="w-3 h-3 rounded-full focus:outline-none"></button>
                    @endforeach
                </div>
            </div>
            
<!-- Product Grid -->
<div class="md:col-span-3 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 sm:gap-8">
    @foreach($products as $product)
        <div class="group bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-lg transition-all duration-300 hover:shadow-2xl flex flex-col h-full">
            <div class="relative aspect-w-1 aspect-h-1 overflow-hidden">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                <div class="absolute inset-0 bg-black bg-opacity-20 group-hover:bg-opacity-50 transition-opacity duration-300"></div>
                @if(isset($product['discount']))
                    <div class="absolute top-4 left-4 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full shadow-md">-{{ $product['discount'] }}%</div>
                @endif
                <div class="absolute bottom-4 left-4 right-4 flex justify-between items-end opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <button class="bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded-full shadow-lg transition-all duration-300 transform hover:scale-110 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50">
                        <i class="fas fa-shopping-cart"></i>
                    </button>
                </div>
            </div>

    <a href="{{ route('details', [$product->category->name, $product->subcategory->name, $product->name]) }}" >
            <div class="p-4 flex-grow flex flex-col justify-between">
                <div>
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-1 truncate">{{ $product['name'] }}</h3>
                    <p class="text-gray-700 dark:text-gray-300 text-sm mb-3 line-clamp-3">
                        {{ strip_tags($product['description']) }}
                    </p>
                    
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-xl font-bold text-yellow-500 dark:text-yellow-400">₣{{ number_format($product['price'], 2) }}</span>
                        @if(isset($product['discounted_price']))
                            <span class="text-sm text-gray-500 line-through">₣{{ number_format($product['discounted_price'], 2) }}</span>
                        @endif
                    </div>
                </div>
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <div class="flex text-yellow-400">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star text-xs"></i>
                            @endfor
                        </div>
                        <span class="text-gray-600 dark:text-gray-400 text-xs ml-1">({{ $product['reviews'] ?? 24 }})</span>
                    </div>
                    <button class="text-gray-400 hover:text-red-500 transition-colors duration-300" title="Add to Wishlist">
                        <i class="far fa-heart"></i>
                    </button>
                </div>
            </div>
        </a>
        </div>
    @endforeach
</div>
        </div>
    </div>
</section>