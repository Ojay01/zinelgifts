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
                        <div class="text-center mb-6">
                            <form action="#" method="POST" enctype="multipart/form-data" id="profile-picture-form">
                                @csrf
                                <div class="w-32 h-32 mx-auto mb-4 relative group">
                                    <img src="{{ auth()->user()->profile_picture ?? '/api/placeholder/128/128' }}" 
                                         alt="Profile Picture" 
                                         class="rounded-full w-full h-full object-cover">
                                    <label for="profile_picture" class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 rounded-full opacity-0 group-hover:opacity-100 cursor-pointer transition-opacity">
                                        <i class="fas fa-camera text-white text-2xl"></i>
                                    </label>
                                    <input type="file" id="profile_picture" name="profile_picture" class="hidden" accept="image/*" onchange="this.form.submit()">
                                </div>
                            </form>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-yellow-500">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h2>
                            <p class="text-gray-600 dark:text-gray-400">Member since {{ auth()->user()->created_at->format('M Y') }}</p>
                        </div>

                        <nav class="space-y-2">
                            @foreach([
                                ['route' => 'profile.information', 'icon' => 'fa-user-circle', 'text' => 'Profile Information'],
                                ['route' => 'profile.orders', 'icon' => 'fa-shopping-bag', 'text' => 'Order History'],
                                ['route' => 'profile.wishlist', 'icon' => 'fa-heart', 'text' => 'Wishlist'],
                                ['route' => 'profile.addresses', 'icon' => 'fa-map-marker-alt', 'text' => 'Addresses'],
                                ['route' => 'profile.settings', 'icon' => 'fa-cog', 'text' => 'Settings']
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
                                    <span class="text-yellow-500 font-semibold">23</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 dark:text-gray-400">Wishlist Items</span>
                                    <span class="text-yellow-500 font-semibold">7</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 dark:text-gray-400">Reviews</span>
                                    <span class="text-yellow-500 font-semibold">12</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dynamic Content Area -->
                <div class="lg:col-span-2">
                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    @yield('profile-content')
                </div>
            </div>
        </div>
    </div>

    <x-footer />

    @push('scripts')
    <script>
        // Profile picture preview
        document.getElementById('profile_picture')?.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('.profile-picture').src = e.target.result;
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
    @endpush
</x-guest-layout>

<!-- profile/tabs/information.blade.php -->


@section('profile-content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 mb-8">
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-yellow-500 mb-6">Profile Information</h2>
    <form action="#" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="firstName" class="block text-gray-700 dark:text-gray-300 mb-2">First Name</label>
                <input type="text" id="firstName" name="firstName" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                       value="{{ old('firstName', auth()->user()->first_name) }}" required>
                @error('firstName')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="lastName" class="block text-gray-700 dark:text-gray-300 mb-2">Last Name</label>
                <input type="text" id="lastName" name="lastName" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                       value="{{ old('lastName', auth()->user()->last_name) }}" required>
                @error('lastName')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-gray-700 dark:text-gray-300 mb-2">Email</label>
                <input type="email" id="email" name="email" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                       value="{{ old('email', auth()->user()->email) }}" required>
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone" class="block text-gray-700 dark:text-gray-300 mb-2">Phone Number</label>
                <input type="tel" id="phone" name="phone" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                       value="{{ old('phone', auth()->user()->phone) }}">
                @error('phone')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-6">
            <label for="bio" class="block text-gray-700 dark:text-gray-300 mb-2">Bio</label>
            <textarea id="bio" name="bio" rows="4" 
                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('bio', auth()->user()->bio) }}</textarea>
            @error('bio')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded-md hover:bg-yellow-600 transition duration-300">
                Save Changes
            </button>
        </div>
    </form>
</div>

<!-- Password Change Section -->
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
    <h2 class="text-2xl font-semibold text-gray-800 dark:text-yellow-500 mb-6">Change Password</h2>
    <form action="#" method="POST">
        @csrf
        @method('PUT')
        
        <div class="space-y-4">
            <div>
                <label for="current_password" class="block text-gray-700 dark:text-gray-300 mb-2">Current Password</label>
                <input type="password" id="current_password" name="current_password" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                       required>
            </div>

            <div>
                <label for="password" class="block text-gray-700 dark:text-gray-300 mb-2">New Password</label>
                <input type="password" id="password" name="password" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                       required>
            </div>

            <div>
                <label for="password_confirmation" class="block text-gray-700 dark:text-gray-300 mb-2">Confirm New Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                       required>
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded-md hover:bg-yellow-600 transition duration-300">
                Update Password
            </button>
        </div>
    </form>
</div>
@endsection

<!-- profile/tabs/orders.blade.php -->


@section('profile-content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-yellow-500">Order History</h2>
        <div class="flex space-x-2">
            <select class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="">All Orders</option>
                <option value="processing">Processing</option>
                <option value="shipped">Shipped</option>
                <option value="delivered">Delivered</option>
            </select>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="text-left border-b dark:border-gray-700">
                    <th class="pb-4 text-gray-600 dark:text-gray-400">Order ID</th>
                    <th class="pb-4 text-gray-600 dark:text-gray-400">Date</th>
                    <th class="pb-4 text-gray-600 dark:text-gray-400">Status</th>
                    <th class="pb-4 text-gray-600 dark:text-gray-400">Total</th>
                    <th class="pb-4 text-gray-600 dark:text-gray-400">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach([
                    ['id' => '#12345', 'date' => '2024-11-15', 'status' => 'Delivered', 'total' => 99.99],
                    ['id' => '#12344', 'date' => '2024-11-10', 'status' => 'In Transit', 'total' => 149.99],
                    ['id' => '#12343', 'date' => '2024-11-05', 'status' => 'Processing', 'total' => 79.99],
                    ['id' => '#12342', 'date' => '2024-11-01', 'status' => 'Delivered', 'total' => 199.99]
                ] as $order)
<tr class="border-b dark:border-gray-700">
    <td class="py-4 text-gray-800 dark:text-gray-300">{{ $order['id'] }}</td>
    <td class="py-4 text-gray-800 dark:text-gray-300">{{ $order['date'] }}</td>
    <td class="py-4">
        <span class="px-3 py-1 rounded-full text-sm font-medium
            @if($order['status'] === 'Delivered') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
            @elseif($order['status'] === 'In Transit') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
            @else bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
            @endif">
            {{ $order['status'] }}
        </span>
    </td>
    <td class="py-4 text-gray-800 dark:text-gray-300">${{ number_format($order['total'], 2) }}</td>
    <td class="py-4">
        <div class="flex space-x-2">
            <a href="#" 
               class="text-yellow-500 hover:text-yellow-600 dark:text-yellow-400 dark:hover:text-yellow-300">
                <i class="fas fa-eye"></i>
                <span class="ml-1">View</span>
            </a>
            <a href="#" 
               class="text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
                <i class="fas fa-truck"></i>
                <span class="ml-1">Track</span>
            </a>
        </div>
    </td>
</tr>
@endforeach
</tbody>
</table>
</div>

<!-- Pagination -->
<div class="mt-6">
<div class="flex items-center justify-between">
<div class="text-sm text-gray-600 dark:text-gray-400">
Showing <span class="font-medium">1</span> to <span class="font-medium">4</span> of <span class="font-medium">4</span> orders
</div>
<div class="flex space-x-2">
<button class="px-3 py-1 border border-gray-300 rounded-md text-gray-600 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-400 dark:hover:bg-gray-700" disabled>
    Previous
</button>
<button class="px-3 py-1 border border-gray-300 rounded-md text-gray-600 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-400 dark:hover:bg-gray-700" disabled>
    Next
</button>
</div>
</div>
</div>
</div>
@endsection

<!-- profile/tabs/wishlist.blade.php -->


@section('profile-content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
<h2 class="text-2xl font-semibold text-gray-800 dark:text-yellow-500 mb-6">My Wishlist</h2>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
@foreach([
['id' => 1, 'name' => 'Wireless Headphones', 'price' => 129.99, 'image' => '/api/placeholder/200/200'],
['id' => 2, 'name' => 'Smart Watch', 'price' => 199.99, 'image' => '/api/placeholder/200/200'],
['id' => 3, 'name' => 'Laptop Stand', 'price' => 49.99, 'image' => '/api/placeholder/200/200'],
['id' => 4, 'name' => 'Mechanical Keyboard', 'price' => 159.99, 'image' => '/api/placeholder/200/200']
] as $item)
<div class="flex space-x-4 p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
<img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-24 h-24 object-cover rounded-lg">
<div class="flex-1">
<h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $item['name'] }}</h3>
<p class="text-yellow-500 font-medium mt-1">${{ number_format($item['price'], 2) }}</p>
<div class="flex space-x-2 mt-3">
    <button class="px-3 py-1 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 transition duration-300">
        Add to Cart
    </button>
    <button class="px-3 py-1 border border-gray-300 text-gray-600 rounded-md hover:bg-gray-50 dark:border-gray-600 dark:text-gray-400 dark:hover:bg-gray-700">
        Remove
    </button>
</div>
</div>
</div>
@endforeach
</div>
</div>
@endsection

<!-- profile/tabs/addresses.blade.php -->


@section('profile-content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
<div class="flex justify-between items-center mb-6">
<h2 class="text-2xl font-semibold text-gray-800 dark:text-yellow-500">My Addresses</h2>
<button class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 transition duration-300">
<i class="fas fa-plus mr-2"></i>Add New Address
</button>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
@foreach([
['id' => 1, 'type' => 'Home', 'address' => '123 Main St', 'city' => 'New York', 'state' => 'NY', 'zip' => '10001', 'default' => true],
['id' => 2, 'type' => 'Office', 'address' => '456 Work Ave', 'city' => 'New York', 'state' => 'NY', 'zip' => '10002', 'default' => false],
['id' => 3, 'type' => 'Other', 'address' => '789 Secondary St', 'city' => 'Brooklyn', 'state' => 'NY', 'zip' => '11201', 'default' => false]
] as $address)
<div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 relative">
@if($address['default'])
<span class="absolute top-4 right-4 bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-200">
Default
</span>
@endif

<div class="flex items-start mb-4">
<div class="p-2 bg-yellow-100 dark:bg-yellow-900 rounded-lg">
    <i class="fas fa-map-marker-alt text-yellow-500"></i>
</div>
<div class="ml-4">
    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $address['type'] }}</h3>
    <p class="text-gray-600 dark:text-gray-400 mt-1">
        {{ $address['address'] }}<br>
        {{ $address['city'] }}, {{ $address['state'] }} {{ $address['zip'] }}
    </p>
</div>
</div>

<div class="flex space-x-2">
<button class="text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
    <i class="fas fa-edit mr-1"></i>Edit
</button>
@unless($address['default'])
<button class="text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200">
    <i class="fas fa-star mr-1"></i>Set as Default
</button>
<button class="text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300">
    <i class="fas fa-trash-alt mr-1"></i>Remove
</button>
@endunless
</div>
</div>
@endforeach
</div>
</div>
@endsection