<!-- resources/views/components/featured-products-section.blade.php -->
@props(['specialOffers' => [
    ['title' => '25 Ideas For Modern Interior', 'subtitle' => 'Adipiscing lorem class', 'image' => 'https://picsum.photos/seed/interior/600/400'],
    ['title' => 'Beds And Sofas With 15% Discount', 'subtitle' => 'Nullam nunc scelerisque', 'image' => 'https://picsum.photos/seed/bedroom/600/400'],
]])

@props(['products' => [
    ['name' => 'Gray Chair', 'image' => 'https://picsum.photos/seed/chair1/300/300', 'price' => 182.00, 'oldPrice' => null, 'category' => 'Retail', 'description' => 'Nec a neque nisi scelerisque ullamcorper parturient quisque justo class dignissim'],
    ['name' => 'Two Pafs', 'image' => 'https://picsum.photos/seed/paf/300/300', 'price' => 168.00, 'oldPrice' => null, 'category' => 'Retail', 'description' => 'Comfortable and stylish pafs for your living room'],
    ['name' => 'Gray Chair', 'image' => 'https://picsum.photos/seed/chair2/300/300', 'price' => 126.00, 'oldPrice' => 168.00, 'category' => 'Retail', 'discount' => 25, 'description' => 'Elegant gray chair with modern design'],
    ['name' => 'Spotlight', 'image' => 'https://picsum.photos/seed/spotlight/300/300', 'price' => 144.00, 'oldPrice' => null, 'category' => 'Retail', 'description' => 'Adjustable spotlight for focused lighting'],
    ['name' => 'Wooden Table', 'image' => 'https://picsum.photos/seed/table/300/300', 'price' => 155.00, 'oldPrice' => null, 'category' => 'Retail', 'description' => 'Sturdy wooden table for your dining room'],
    ['name' => 'Wood Wardrobes', 'image' => 'https://picsum.photos/seed/wardrobe/300/300', 'price' => 199.00, 'oldPrice' => null, 'category' => 'Retail', 'description' => 'Spacious wooden wardrobes for ample storage'],
    ['name' => 'Table Wood Light', 'image' => 'https://picsum.photos/seed/light/300/300', 'price' => 124.00, 'oldPrice' => null, 'category' => 'Retail', 'description' => 'Wooden table lamp for a warm ambiance'],
    ['name' => 'Kids Chair', 'image' => 'https://picsum.photos/seed/kidschair/300/300', 'price' => 173.00, 'oldPrice' => null, 'category' => 'Retail', 'description' => 'Colorful and comfortable chair for children'],
]])

<section class="bg-white py-16" x-data="{ activeTab: 'special', activeSlide: 0 }">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-8">
            <div class="flex space-x-4 overflow-x-auto pb-2">
                <button @click="activeTab = 'special'" :class="{ 'text-yellow-500 border-b-2 border-yellow-500': activeTab === 'special' }" class="pb-2 font-semibold whitespace-nowrap">SPECIAL OFFER</button>
                <button @click="activeTab = 'new'" :class="{ 'text-yellow-500 border-b-2 border-yellow-500': activeTab === 'new' }" class="pb-2 font-semibold whitespace-nowrap">NEW</button>
                <button @click="activeTab = 'featured'" :class="{ 'text-yellow-500 border-b-2 border-yellow-500': activeTab === 'featured' }" class="pb-2 font-semibold whitespace-nowrap">FEATURED</button>
            </div>
            <div class="flex space-x-2">
                <button @click="activeSlide = (activeSlide - 1 + {{ count($specialOffers) }}) % {{ count($specialOffers) }}" class="text-gray-500 hover:text-yellow-500">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button @click="activeSlide = (activeSlide + 1) % {{ count($specialOffers) }}" class="text-gray-500 hover:text-yellow-500">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Special Offer Slider -->
            <div class="md:col-span-1 relative h-96">
                @foreach($specialOffers as $index => $offer)
                    <div x-show="activeSlide === {{ $index }}" class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $offer['image'] }}');">
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-end p-6 text-white">
                            <h3 class="text-2xl font-bold mb-2">{{ $offer['title'] }}</h3>
                            <p class="mb-4">{{ $offer['subtitle'] }}</p>
                            <button class="bg-yellow-500 text-black py-2 px-4 rounded-full inline-block w-max">VIEW MORE</button>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Product Grid -->
            <div class="md:col-span-2 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($products as $product)
                    <div class="relative overflow-hidden group">
                        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-48 object-cover">
                        @if(isset($product['discount']))
                            <span class="absolute top-2 right-2 bg-green-500 text-white rounded-full px-2 py-1 text-xs">-{{ $product['discount'] }}%</span>
                        @endif
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-70 flex flex-col justify-between p-4 transition-all duration-300">
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <h3 class="text-white font-semibold mb-2">{{ $product['name'] }}</h3>
                                <p class="text-white text-sm">{{ $product['description'] }}</p>
                            </div>
                            <div class="flex justify-between items-center">
                                <div class="text-white">
                                    <span class="font-bold">₣{{ number_format($product['price'], 2) }}</span>
                                    @if(isset($product['oldPrice']))
                                        <span class="line-through ml-2">₣{{ number_format($product['oldPrice'], 2) }}</span>
                                    @endif
                                </div>
                                <div class="flex space-x-2">
                                    <button class="bg-white text-black p-2 rounded-full"><i class="fas fa-heart"></i></button>
                                    <button class="bg-white text-black p-2 rounded-full"><i class="fas fa-shopping-cart"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>