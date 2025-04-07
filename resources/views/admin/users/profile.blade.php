<!-- resources/views/profile/show.blade.php -->
<x-admin-layout>
    <div class="mt-6 sm:mt-8 container mx-auto px-4">
        <div class="bg-slate-800 rounded-xl border border-slate-700 shadow-xl transition-all duration-300 hover:shadow-2xl">
            <div class="p-5 sm:p-7 space-y-6">
                <!-- Header with animation -->
                <div class="flex items-center justify-between border-b border-slate-700 pb-4">
                    <h3 class="text-xl font-bold text-white flex items-center space-x-2">
                        <a href="{{ route('users.index') }}" class="text-slate-400 hover:text-slate-200 transition-colors">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <span>{{ $user->name }}'s Profile</span>
                        @if($user->profile?->verified)
                            <i class="fas fa-check-circle text-blue-400 ml-1"></i>
                        @endif
                    </h3>
                    <a 
                        href="#" 
                        class="inline-flex items-center px-4 py-2 bg-slate-700 text-sm font-medium rounded-lg text-gray-200 hover:bg-slate-600 transition-colors duration-200"
                    >
                        <i class="fas fa-edit mr-2"></i>
                        Edit Profile
                    </a>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8">
                    <!-- Left Column - Basic Info -->
                    <div class="space-y-6">
                        <!-- Avatar with hover effect -->
                        <div class="flex justify-center">
                            <div class="relative group">
                                @if($user->profile?->avatar)
                                    <img src="{{ Storage::url($user->profile->avatar) }}" 
                                         alt="{{ $user->name }}" 
                                         class="h-36 w-36 rounded-full object-cover border-4 border-slate-600 transition-transform duration-300 group-hover:scale-105">
                                @else
                                    <div class="h-36 w-36 rounded-full bg-gradient-to-br from-slate-700 to-slate-600 flex items-center justify-center text-4xl text-gray-300 transition-transform duration-300 group-hover:scale-105">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                @endif
                                <div class="absolute bottom-0 right-0 h-8 w-8 bg-slate-700 rounded-full border-4 border-slate-800 flex items-center justify-center">
                                    <i class="fas fa-camera text-gray-300 text-sm"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Basic Information -->
                        <div class="bg-slate-700/50 rounded-lg p-6 backdrop-blur-sm border border-slate-600/30 shadow-lg">
                            <h4 class="text-gray-200 font-medium mb-6 flex items-center space-x-2">
                                <i class="fas fa-id-card text-blue-400"></i>
                                <span>Basic Information</span>
                            </h4>
                            <div class="space-y-5">
                                <div class="group flex items-start space-x-3 p-2 rounded-md hover:bg-slate-700/70 transition-all duration-200">
                                    <i class="fas fa-user text-gray-400 mt-1 group-hover:text-blue-400 transition-colors"></i>
                                    <div>
                                        <p class="text-sm text-gray-400">Name</p>
                                        <p class="text-gray-200 font-medium group-hover:text-blue-400 transition-colors duration-200">{{ $user->name }}</p>
                                    </div>
                                </div>
                                <div class="group flex items-start space-x-3 p-2 rounded-md hover:bg-slate-700/70 transition-all duration-200">
                                    <i class="fas fa-envelope text-gray-400 mt-1 group-hover:text-blue-400 transition-colors"></i>
                                    <div>
                                        <p class="text-sm text-gray-400">Email</p>
                                        <p class="text-gray-200 font-medium group-hover:text-blue-400 transition-colors duration-200">{{ $user->email }}</p>
                                    </div>
                                </div>
                                <div class="group flex items-start space-x-3 p-2 rounded-md hover:bg-slate-700/70 transition-all duration-200">
                                    <i class="fas fa-venus-mars text-gray-400 mt-1 group-hover:text-blue-400 transition-colors"></i>
                                    <div>
                                        <p class="text-sm text-gray-400">Gender</p>
                                        <p class="text-gray-200 font-medium group-hover:text-blue-400 transition-colors duration-200">
                                            {{ ucfirst($user->profile?->gender ?? 'Not specified') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="group flex items-start space-x-3 p-2 rounded-md hover:bg-slate-700/70 transition-all duration-200">
                                    <i class="fas fa-phone text-gray-400 mt-1 group-hover:text-blue-400 transition-colors"></i>
                                    <div>
                                        <p class="text-sm text-gray-400">Phone</p>
                                        <p class="text-gray-200 font-medium group-hover:text-blue-400 transition-colors duration-200">{{ $user->number ?? 'Not provided' }}</p>
                                    </div>
                                </div>
                                <div class="group flex items-start space-x-3 p-2 rounded-md hover:bg-slate-700/70 transition-all duration-200">
                                    <i class="fas fa-calendar-alt text-gray-400 mt-1 group-hover:text-blue-400 transition-colors"></i>
                                    <div>
                                        <p class="text-sm text-gray-400">Member Since</p>
                                        <p class="text-gray-200 font-medium group-hover:text-blue-400 transition-colors duration-200">{{ $user->created_at->format('M d, Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Middle Column - Addresses -->
                    <div class="space-y-6">
                        <!-- Default Shipping Address -->
                        <div class="bg-slate-700/50 rounded-lg p-6 backdrop-blur-sm">
                            <h4 class="text-gray-200 font-medium mb-4 flex items-center space-x-2">
                                <i class="fas fa-map-marker-alt text-gray-400"></i>
                                <span>Default Shipping Address</span>
                            </h4>
                            @if($user->profile?->default_shipping_address)
                                <div class="space-y-2 group">
                                    <p class="text-gray-200 group-hover:text-blue-400 transition-colors duration-200">{{ $user->profile->default_shipping_address }}</p>
                                    <p class="text-gray-200 group-hover:text-blue-400 transition-colors duration-200">
                                        {{ $user->profile->city }}, {{ $user->profile->state }} {{ $user->profile->postal_code }}
                                    </p>
                                    <p class="text-gray-200 group-hover:text-blue-400 transition-colors duration-200">{{ $user->profile->country }}</p>
                                </div>
                            @else
                                <div class="flex items-center justify-center h-24 border-2 border-dashed border-slate-600 rounded-lg">
                                    <div class="text-center">
                                        <i class="fas fa-home text-gray-500 text-2xl mb-2"></i>
                                        <p class="text-gray-400">No shipping address provided</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Default Billing Address -->
                        <div class="bg-slate-700/50 rounded-lg p-6 backdrop-blur-sm">
                            <h4 class="text-gray-200 font-medium mb-4 flex items-center space-x-2">
                                <i class="fas fa-credit-card text-gray-400"></i>
                                <span>Default Billing Address</span>
                            </h4>
                            @if($user->profile?->default_billing_address)
                                <div class="space-y-2 group">
                                    <p class="text-gray-200 group-hover:text-blue-400 transition-colors duration-200">{{ $user->profile->default_billing_address }}</p>
                                    <p class="text-gray-200 group-hover:text-blue-400 transition-colors duration-200">
                                        {{ $user->profile->city }}, {{ $user->profile->state }} {{ $user->profile->postal_code }}
                                    </p>
                                    <p class="text-gray-200 group-hover:text-blue-400 transition-colors duration-200">{{ $user->profile->country }}</p>
                                </div>
                            @else
                                <div class="flex items-center justify-center h-24 border-2 border-dashed border-slate-600 rounded-lg">
                                    <div class="text-center">
                                        <i class="fas fa-file-invoice text-gray-500 text-2xl mb-2"></i>
                                        <p class="text-gray-400">No billing address provided</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Right Column - Additional Info -->
                    <div class="space-y-6">
                        <!-- Preferences -->
                        <div class="bg-slate-700/50 rounded-lg p-6 backdrop-blur-sm">
                            <h4 class="text-gray-200 font-medium mb-4 flex items-center space-x-2">
                                <i class="fas fa-cog text-gray-400"></i>
                                <span>Preferences</span>
                            </h4>
                            <div class="space-y-4">
                                <div class="group">
                                    <p class="text-sm text-gray-400">Newsletter</p>
                                   
                                    <div class="flex items-center space-x-2">
                                        <span class="text-gray-200 font-medium group-hover:text-blue-400 transition-colors duration-200">
                                            {{ $user->newsletter_subscribed ? 'Subscribed' : 'Not subscribed' }}
                                        </span>
                                        
                                        @if($user->newsletter_subscribed)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-900 text-blue-200">
                                                <i class="fas fa-check-circle mr-1 text-xs"></i>
                                                Active
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                @if($user->profile?->preferences)
                                    @foreach($user->profile->preferences as $key => $value)
                                        <div class="group">
                                            <p class="text-sm text-gray-400">{{ ucfirst($key) }}</p>
                                            <p class="text-gray-200 font-medium group-hover:text-blue-400 transition-colors duration-200">{{ $value }}</p>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <!-- Account Statistics -->
                        <div class="bg-slate-700/50 rounded-lg p-6 backdrop-blur-sm">
                            <h4 class="text-gray-200 font-medium mb-4 flex items-center space-x-2">
                                <i class="fas fa-chart-bar text-gray-400"></i>
                                <span>Account Statistics</span>
                            </h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-slate-800/50 rounded-lg p-4 group hover:bg-slate-800 transition-colors duration-200">
                                    <div class="flex items-center text-sm text-gray-400">
                                        <i class="fas fa-shopping-cart mr-2"></i>
                                        <p>Total Orders</p>
                                    </div>
                                    <div class="mt-2 flex items-end space-x-2">
                                        <p class="text-2xl font-bold text-gray-200 group-hover:text-blue-400 transition-colors duration-200">
                                            {{ $user->orders_count ?? 0 }}
                                        </p>
                                        @if(($user->orders_last_month ?? 0) > 0)
                                            <span class="text-xs text-green-400 mb-1 flex items-center">
                                                <i class="fas fa-arrow-up mr-1"></i>
                                                +{{ $user->orders_last_month ?? 0 }} last month
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="bg-slate-800/50 rounded-lg p-4 group hover:bg-slate-800 transition-colors duration-200">
                                    <div class="flex items-center text-sm text-gray-400">
                                        <i class="fas fa-star mr-2"></i>
                                        <p>Reviews</p>
                                    </div>
                                    <div class="mt-2 flex items-end space-x-2">
                                        <p class="text-2xl font-bold text-gray-200 group-hover:text-blue-400 transition-colors duration-200">
                                            {{ $user->reviews_count ?? 0 }}
                                        </p>
                                        @if(($user->reviews_count ?? 0) > 0)
                                            <div class="flex items-center mb-1">
                                                <i class="fas fa-star text-yellow-400"></i>
                                                <span class="text-xs text-gray-400 ml-1">{{ number_format($user->average_rating ?? 0, 1) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="bg-slate-800/50 rounded-lg p-4 group hover:bg-slate-800 transition-colors duration-200">
                                    <div class="flex items-center text-sm text-gray-400">
                                        <i class="fas fa-heart mr-2"></i>
                                        <p>Wishlist Items</p>
                                    </div>
                                    <p class="mt-2 text-2xl font-bold text-gray-200 group-hover:text-blue-400 transition-colors duration-200">
                                        {{ $user->wishlist_count ?? 0 }}
                                    </p>
                                </div>
                                <div class="bg-slate-800/50 rounded-lg p-4 group hover:bg-slate-800 transition-colors duration-200">
                                    <div class="flex items-center text-sm text-gray-400">
                                        <i class="fas fa-receipt mr-2"></i>
                                        <p>Last Order</p>
                                    </div>
                                    <p class="mt-2 text-gray-200 font-medium group-hover:text-blue-400 transition-colors duration-200">
                                        {{ $user->latest_order?->created_at?->format('M d, Y') ?? 'No orders yet' }}
                                    </p>
                                </div>
                                <div class="bg-slate-800/50 rounded-lg p-4 group hover:bg-slate-800 transition-colors duration-200 col-span-2">
                                    <div class="flex items-center text-sm text-gray-400">
                                        <i class="fas fa-shopping-basket mr-2"></i>
                                        <p>Cart Items</p>
                                    </div>
                                    <div class="flex items-center justify-between mt-2">
                                        <p class="text-2xl font-bold text-gray-200 group-hover:text-blue-400 transition-colors duration-200">
                                            {{ $user->cart_count ?? 0 }}
                                        </p>
                                        @if(($user->cart_count ?? 0) > 0)
                                            <a href="#" class="text-blue-400 hover:text-blue-300 text-sm flex items-center">
                                                <span>View Cart</span>
                                                <i class="fas fa-arrow-right ml-1"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>