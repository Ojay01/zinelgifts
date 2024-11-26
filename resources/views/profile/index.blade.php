<!-- profile/show.blade.php -->
<x-guest-layout>
    <x-header />

    <div class="bg-gray-100 dark:bg-gray-900 py-16 min-h-screen">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold text-center text-gray-800 dark:text-yellow-500 mb-4">My Profile</h1>
            <div class="w-24 h-1 bg-yellow-500 mx-auto mb-12"></div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Profile Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 sticky top-0">
                        <div class="text-center mb-6 relative">
                            <form 
                                action="{{ route('profile.updateProfilePicture') }}" 
                                method="POST" 
                                enctype="multipart/form-data" 
                                id="profile-picture-form"
                                class="group"
                            >
                                @csrf
                                <div class="w-36 h-36 mx-auto mb-4 relative">
                                    <div class="w-full h-full rounded-full overflow-hidden shadow-md border-4 border-white dark:border-gray-800 transition-all duration-300 group-hover:shadow-lg">
                                        <img 
                                            src="{{ auth()->user()->profile_photo_path ? Storage::url(auth()->user()->profile_photo_path) : '/userplaceholder.png' }}" 
                                            alt="Profile Photo" 
                                            class="w-full h-full object-cover transform transition-transform duration-300 group-hover:scale-105"
                                        >
                                    </div>
                                    
                                    <label 
                                        for="profile_picture" 
                                        class="
                                            absolute inset-0 flex items-center justify-center 
                                            bg-black bg-opacity-50 rounded-full 
                                            opacity-0 group-hover:opacity-100 
                                            cursor-pointer transition-all duration-300 
                                            hover:bg-opacity-70
                                        "
                                    >
                                        <div class="text-center">
                                            <i class="fas fa-camera text-white text-2xl"></i>
                                            <span class="block text-white text-xs mt-1">Change Photo</span>
                                        </div>
                                    </label>
                                    
                                    <input 
                                        type="file" 
                                        id="profile_picture" 
                                        name="profile_picture" 
                                        class="hidden" 
                                        accept="image/jpeg,image/png,image/webp" 
                                        onchange="this.form.submit()"
                                    >
                                </div>
                            </form>
                        
                            <div class="relative">
                                <h2 class="
                                    text-xl font-semibold 
                                    text-gray-800 dark:text-yellow-500 
                                    transition-colors duration-300 
                                    hover:text-blue-600 dark:hover:text-yellow-400 uppercase
                                ">
                                    {{ auth()->user()->name }} 
                                </h2>
                                <p class="
                                    text-gray-600 dark:text-gray-400 
                                    text-sm 
                                    flex items-center justify-center 
                                    gap-2
                                ">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Member since {{ auth()->user()->created_at->format('M Y') }}
                                </p>
                            </div>
                        </div>

                        <nav class="space-y-2">
                            @foreach([
                                ['route' => 'profile.information', 'icon' => 'fa-user-circle', 'text' => 'Profile Information'],
                                ['route' => 'profile.orders', 'icon' => 'fa-shopping-bag', 'text' => 'Order History'],
                                ['route' => 'profile.wishlist', 'icon' => 'fa-heart', 'text' => 'Wishlist'],
                                ['route' => 'profile.addresses', 'icon' => 'fa-map-marker-alt', 'text' => 'Addresses'],
                                ['route' => 'profile.settings', 'icon' => 'fa-shopping-cart', 'text' => 'My Cart']
                            ] as $item)
                                <a href="{{ route($item['route']) }}" 
                                   class="flex items-center space-x-2 p-3 rounded-lg {{ request()->routeIs($item['route']) ? 'bg-yellow-500 text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-yellow-50 dark:hover:bg-gray-700' }}">
                                    <i class="fas {{ $item['icon'] }}"></i>
                                    <span>{{ $item['text'] }}</span>
                                </a>
                            @endforeach
                        </nav>

                        <!-- Quick Stats -->
                        <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-yellow-500 mb-4">Account Overview</h3>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 dark:text-gray-400">Total Orders</span>
                                    <span class="text-yellow-500 font-semibold">0</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 dark:text-gray-400">Wishlist Items</span>
                                    <span class="text-yellow-500 font-semibold">0</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 dark:text-gray-400">Reviews</span>
                                    <span class="text-yellow-500 font-semibold">0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dynamic Content Area -->
                <div class="lg:col-span-2">
                  

                    @yield('profile-content')
                </div>
            </div>
        </div>
    </div>

    <x-footer />

</x-guest-layout>