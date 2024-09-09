<x-guest-layout>
    <x-header />

    <div class="bg-gray-100 dark:bg-gray-900 py-16">
        <div class="container mx-auto px-4">
            <!-- Blog Details -->
            <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <img src="{{ asset('storage/' . $blog->thumbnail) }}" alt="{{ $blog->title }}" class="w-full h-64 object-cover">

                <div class="p-6">
                    <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-4">{{ $blog->title }}</h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">{{ $blog->created_at->format('M d, Y') }}</p>

                    <!-- Blog Content with Images -->
                    <div class="text-gray-700 dark:text-gray-300 leading-relaxed">
                        {!! nl2br($blog->body) !!}
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
