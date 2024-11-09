<!-- resources/views/errors/404.blade.php -->
@php
    $errors = new \Illuminate\Support\MessageBag;
@endphp

<x-guest-layout>
    <x-header :errors="$errors" />
    <div class="bg-gray-100 dark:bg-gray-900 py-32">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto text-center">
                <div class="mb-8 text-yellow-500">
                    <i class="fas fa-exclamation-circle text-8xl"></i>
                </div>
                
                <h1 class="text-6xl font-bold mb-4 text-gray-800 dark:text-white">
                    404
                </h1>
                
                <h2 class="text-2xl font-bold mb-8 text-gray-700 dark:text-gray-200">
                    Oops! Page Not Found
                </h2>
                
                <p class="text-gray-600 dark:text-gray-400 mb-12 text-lg">
                    The page you're looking for seems to have wandered off. Let's get you back on track!
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/" 
                       class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-8 rounded-md transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50 shadow-lg">
                        Go Home
                    </a>
                    
                    <a href="{{ route('shop') }}" 
                       class="bg-gray-800 dark:bg-gray-700 hover:bg-gray-700 dark:hover:bg-gray-600 text-white font-bold py-3 px-8 rounded-md transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 shadow-lg">
                        Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </div>
    <x-footer />
</x-guest-layout>