<!-- resources/views/blog-details.blade.php -->
@php
    // Dummy blog post data for details page (usually, this would be passed from a controller)
    $blog = (object)[
        'id' => 1,
        'title' => 'Understanding Tailwind CSS',
        'content' => '
            Tailwind CSS is a utility-first framework that allows you to build custom designs without having to leave your HTML. With classes like "flex", "mt-4", and "text-center", you can easily create responsive, flexible, and reusable layouts.
            <br><br>
            <img src="https://via.placeholder.com/800x400?text=Tailwind+CSS+Utility" alt="Tailwind Utility Example" class="my-4 w-full h-auto">
            <br>
            This framework provides great flexibility and simplicity in design by using a collection of utility classes. You don’t need to write any custom CSS to achieve your designs, which keeps your codebase clean and efficient.
            <br><br>
            <img src="https://via.placeholder.com/800x400?text=Responsive+Design" alt="Responsive Design" class="my-4 w-full h-auto">
            <br>
            It also helps in making responsive designs, where you can control your layouts at various screen sizes using responsive utilities.
        ',
        'created_at' => now(),
        'image_url' => 'https://via.placeholder.com/800x400?text=Tailwind+CSS',
    ];
@endphp

<x-guest-layout>
    <x-header />

    <div class="bg-gray-100 dark:bg-gray-900 py-16">
        <div class="container mx-auto px-4">
            <!-- Blog Details -->
            <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="w-full h-64 object-cover">

                <div class="p-6">
                    <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">{{ $blog->title }}</h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">{{ $blog->created_at->format('M d, Y') }}</p>

                    <!-- Blog Content with Images -->
                    <div class="text-gray-700 dark:text-gray-300 leading-relaxed">
                        {!! nl2br($blog->content) !!}
                    </div>

                    <!-- Back to Blogs -->
                    <div class="mt-6">
                        <a href="{{ route('blogs') }}" class="text-yellow-500 hover:text-yellow-600 font-semibold">&larr; Back to All Blogs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-footer />
</x-guest-layout>
