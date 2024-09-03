<!-- resources/views/components/category-section.blade.php -->
@props(['categories' => [
    ['name' => 'LIGHTING', 'image' => 'https://cdn.pixabay.com/photo/2014/09/20/13/54/glowing-453783_1280.jpg', 'products' => 17, 'link' => '#'],
    ['name' => 'CLOCKS', 'image' => 'https://cdn.pixabay.com/photo/2016/03/23/12/53/clock-1274699_1280.jpg', 'products' => 12, 'link' => '#'],
    ['name' => 'FURNITURE', 'image' => 'https://cdn.pixabay.com/photo/2016/12/31/09/04/shouzhu-1942384_1280.jpg', 'products' => 33, 'link' => '#'],
    ['name' => 'ACCESSORIES', 'image' => 'https://cdn.pixabay.com/photo/2023/05/31/18/48/watch-8032054_1280.jpg', 'products' => 12, 'link' => '#'],
]])

<section class="bg-white dark:bg-gray-800 py-16 transition-colors duration-300">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center text-gray-800 dark:text-white mb-2">TOP CATEGORIES</h2>
        <div class="w-24 h-1 bg-yellow-500 mx-auto mb-12"></div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($categories as $category)
                <a href="{{ $category['link'] }}" class="group">
                    <div class="bg-white dark:bg-gray-700 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 h-96">
                        <div class="relative h-3/4 overflow-hidden">
                            <img 
                                src="{{ $category['image'] }}" 
                                alt="{{ $category['name'] }}" 
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-70"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-6">
                                <h3 class="text-white text-2xl font-bold mb-2 transform translate-y-2 transition-transform duration-300 group-hover:translate-y-0">{{ $category['name'] }}</h3>
                                <p class="text-yellow-400 text-sm transform translate-y-4 opacity-0 transition-all duration-300 group-hover:translate-y-0 group-hover:opacity-100">
                                    Explore {{ $category['products'] }} products
                                </p>
                            </div>
                        </div>
                        <div class="h-1/4 flex items-center justify-between px-6">
                            <span class="text-gray-600 dark:text-gray-300 text-sm">{{ $category['products'] }} items</span>
                            <span class="text-yellow-500 group-hover:text-yellow-600 transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>