<x-guest-layout>
    <x-header />

    <!-- Full-height container -->
    <div class="min-h-screen flex flex-col bg-gray-100 dark:bg-gray-900">
        <!-- Main content area -->
        <div class="flex-grow py-16">
            <div class="container mx-auto px-4">
                <!-- Page Title -->
                <h1 class="text-4xl font-bold mb-4 text-gray-800 dark:text-white text-center">Our Blog</h1>
                <div class="w-24 h-1 bg-yellow-500 mx-auto mb-12"></div>

                <!-- Blog List -->
                @if($blogs->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                        @foreach($blogs as $blog)
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                                <img src="{{ asset('storage/' . $blog->thumbnail) }}" alt="{{ $blog->title }}" class="w-full h-48 object-cover">
                                <div class="p-6">
                                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">{{ $blog->title }}</h2>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">{{ $blog->created_at->format('M d, Y') }}</p>
                                    <p class="text-gray-600 dark:text-gray-300">{!! Str::limit($blog->body, 150) !!}</p>
                                    <a href="{{ route('blog.details', $blog->slug) }}" class="block mt-4 text-yellow-500 hover:text-yellow-600 font-semibold">Read More</a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $blogs->links() }}
                    </div>
                @else
                    <!-- No Blog Found Message -->
                    <div class="text-center text-gray-500 dark:text-gray-400">
                        <h2 class="text-2xl font-bold mb-4">No blog posts available</h2>
                        <p>We haven't published any blog posts yet. Please check back later!</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Footer -->
        <x-footer />
    </div>
</x-guest-layout>
