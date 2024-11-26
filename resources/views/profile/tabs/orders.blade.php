<!-- profile/tabs/orders.blade.php -->
@extends('profile.index')

@section('profile-content')


<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
  
        <div class="text-center py-8">
            <div class="text-gray-400 dark:text-gray-500 mb-4">
                <i class="fas fa-shopping-bag fa-3x"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">No orders found</h3>
            <p class="text-gray-600 dark:text-gray-400">Start shopping to see your orders here!</p>
            <a href="{{ route('shop') }}" class="mt-4 inline-block bg-yellow-500 text-white px-6 py-2 rounded-md hover:bg-yellow-600 transition duration-300">
                Browse Products
            </a>
        </div>


</div>
@endsection