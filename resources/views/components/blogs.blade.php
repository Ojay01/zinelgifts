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

<section class="bg-white py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-black mb-2">OUR BLOG</h2>
        <div class="w-20 h-1 bg-yellow-500 mx-auto mb-12"></div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($blogs as $blog)
                <div class="bg-gray-100 rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow duration-300">
                    <img src="{{ $blog['image'] }}" alt="{{ $blog['title'] }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-sm text-yellow-500 font-semibold">{{ $blog['category'] }}</span>
                            <span class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($blog['date'])->format('M d, Y') }}</span>
                        </div>
                        <h3 class="text-xl font-bold mb-2 hover:text-yellow-500 transition-colors duration-300">
                            <a href="#">{{ $blog['title'] }}</a>
                        </h3>
                        <p class="text-gray-600 mb-4">{{ $blog['excerpt'] }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500">By {{ $blog['author'] }}</span>
                            <a href="#" class="text-yellow-500 hover:text-yellow-600 font-semibold">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <a href="#" class="bg-yellow-500 text-black font-bold py-3 px-8 rounded-full hover:bg-yellow-400 transition-colors duration-300">View All Posts</a>
        </div>
    </div>
</section>