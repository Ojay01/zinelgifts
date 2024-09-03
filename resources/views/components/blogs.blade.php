<!-- resources/views/components/blogs-section.blade.php -->
@props(['blogs' => [
    [
        'title' => '10 Tips for a Cozy Living Room',
        'image' => 'https://picsum.photos/seed/livingroom/600/400',
        'excerpt' => 'Discover how to transform your living room into a warm and inviting space with these easy tips.',
        'date' => '2023-05-15',
        'author' => 'Jane Doe',
        'category' => 'Interior Design'
    ],
    [
        'title' => 'The Rise of Sustainable Furniture',
        'image' => 'https://picsum.photos/seed/sustainable/600/400',
        'excerpt' => 'Explore the growing trend of eco-friendly furniture and how it\'s shaping the future of home decor.',
        'date' => '2023-05-10',
        'author' => 'John Smith',
        'category' => 'Sustainability'
    ],
    [
        'title' => 'Maximizing Space in Small Apartments',
        'image' => 'https://picsum.photos/seed/apartment/600/400',
        'excerpt' => 'Learn clever storage solutions and design tricks to make the most of your compact living space.',
        'date' => '2023-05-05',
        'author' => 'Emily Brown',
        'category' => 'Small Spaces'
    ]
]])

<section class="bg-white dark:bg-gray-800 py-16 transition-colors duration-300">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-gray-800 dark:text-white mb-2">OUR BLOG</h2>
        <div class="w-20 h-1 bg-yellow-500 mx-auto mb-12"></div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($blogs as $blog)
                <article class="bg-white dark:bg-gray-700 rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="relative">
                        <img src="{{ $blog['image'] }}" alt="{{ $blog['title'] }}" class="w-full h-56 object-cover">
                        <div class="absolute top-0 left-0 bg-yellow-500 text-black text-xs font-bold px-3 py-1 m-2 rounded-full">
                            {{ $blog['category'] }}
                        </div>
                    </div>
                    <div class="p-6">
                        <time datetime="{{ $blog['date'] }}" class="text-sm text-gray-500 dark:text-gray-400 mb-2 block">
                            {{ \Carbon\Carbon::parse($blog['date'])->format('M d, Y') }}
                        </time>
                        <h3 class="text-xl font-bold mb-3 text-gray-800 dark:text-white hover:text-yellow-500 dark:hover:text-yellow-400 transition-colors duration-300">
                            <a href="#" class="hover:underline">{{ $blog['title'] }}</a>
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4 line-clamp-3">{{ $blog['excerpt'] }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500 dark:text-gray-400">By {{ $blog['author'] }}</span>
                            <a href="#" class="text-yellow-500 hover:text-yellow-600 dark:text-yellow-400 dark:hover:text-yellow-300 font-semibold inline-flex items-center group">
                                Read More
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 group-hover:translate-x-1 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <a href="#" class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-3 px-8 rounded-full transition-colors duration-300 inline-flex items-center group">
                View All Posts
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2 group-hover:translate-x-1 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
    </div>
</section>