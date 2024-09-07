<!-- resources/views/blogs.blade.php -->
@php
    // Dummy blog data
    $blogs = [
        (object)[
            'id' => 1,
            'title' => 'Understanding Tailwind CSS',
            'excerpt' => 'Tailwind CSS is a utility-first framework that makes it easy to build responsive and modern interfaces quickly...',
            'created_at' => now(),
            'image_url' => 'https://via.placeholder.com/400x200?text=Blog+Post+1',
        ],
        (object)[
            'id' => 2,
            'title' => '10 Tips for Writing Cleaner Code',
            'excerpt' => 'Writing clean code is essential for long-term maintainability and collaboration. In this post, we cover 10 key tips...',
            'created_at' => now()->subDays(2),
            'image_url' => 'https://via.placeholder.com/400x200?text=Blog+Post+2',
        ],
        (object)[
            'id' => 3,
            'title' => 'The Future of Web Development',
            'excerpt' => 'The web development landscape is changing rapidly. Let’s take a look at the trends and technologies that will define the future...',
            'created_at' => now()->subWeek(),
            'image_url' => 'https://via.placeholder.com/400x200?text=Blog+Post+3',
        ],
        (object)[
            'id' => 4,
            'title' => 'Building Scalable Applications',
            'excerpt' => 'Scalability is key to the success of any web application. Learn best practices for building scalable systems...',
            'created_at' => now()->subMonth(),
            'image_url' => 'https://via.placeholder.com/400x200?text=Blog+Post+4',
        ],
        (object)[
            'id' => 5,
            'title' => 'How to Optimize Your Website for SEO',
            'excerpt' => 'SEO is essential for increasing your website’s visibility. This post will walk you through the most important optimization techniques...',
            'created_at' => now()->subDays(10),
            'image_url' => 'https://via.placeholder.com/400x200?text=Blog+Post+5',
        ],
        (object)[
            'id' => 6,
            'title' => 'Exploring Laravel and Vue.js',
            'excerpt' => 'Laravel and Vue.js make a powerful pair for building modern web applications. Here’s how to integrate the two in your projects...',
            'created_at' => now()->subDays(20),
            'image_url' => 'https://via.placeholder.com/400x200?text=Blog+Post+6',
        ]
    ];
@endphp

<x-guest-layout>
    <x-header />

    <div class="bg-gray-100 dark:bg-gray-900 py-16">
        <div class="container mx-auto px-4">
            <!-- Page Title -->
            <h1 class="text-4xl font-bold mb-12 text-gray-800 dark:text-white text-center">Our Blog</h1>

            <!-- Blog List -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @foreach($blogs as $blog)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                    <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">{{ $blog->title }}</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">{{ $blog->created_at->format('M d, Y') }}</p>
                        <p class="text-gray-600 dark:text-gray-300">{{ Str::limit($blog->excerpt, 150) }}</p>
                        <a href="{{ route('blog.details', $blog->id) }}" class="block mt-4 text-yellow-500 hover:text-yellow-600 font-semibold">Read More</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <x-footer />
</x-guest-layout>
