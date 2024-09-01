<!-- resources/views/components/category-section.blade.php -->
@props(['categories' => [
    ['name' => 'LIGHTING', 'image' => 'https://cdn.pixabay.com/photo/2014/09/20/13/54/glowing-453783_1280.jpg', 'products' => 17, 'link' => '#'],
    ['name' => 'CLOCKS', 'image' => 'https://cdn.pixabay.com/photo/2016/03/23/12/53/clock-1274699_1280.jpg', 'products' => 12, 'link' => '#'],
    ['name' => 'FURNITURE', 'image' => 'https://cdn.pixabay.com/photo/2016/12/31/09/04/shouzhu-1942384_1280.jpg', 'products' => 33, 'link' => '#'],
    ['name' => 'ACCESSORIES', 'image' => 'https://cdn.pixabay.com/photo/2023/05/31/18/48/watch-8032054_1280.jpg', 'products' => 12, 'link' => '#'],
]])

<section class="bg-gray-300 py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-black mb-2">TOP CATEGORIES</h2>
        <div class="w-20 h-1 bg-yellow-500 mb-8"></div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($categories as $category)
                <a href="{{ $category['link'] }}" class="group block">
                    <div class="flex flex-col items-center">
                        <div class="bg-gray-100 rounded-lg mb-4 w-full aspect-square overflow-hidden">
                            <img src="{{ $category['image'] }}" alt="{{ $category['name'] }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                        </div>
                        <h3 class="text-black font-semibold text-lg mb-1 group-hover:text-yellow-500 transition-colors duration-300">{{ $category['name'] }}</h3>
                        <p class="text-gray-600 text-sm">{{ $category['products'] }} products</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>