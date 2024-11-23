<!-- resources/views/profile/show.blade.php -->
<x-admin-layout>
    <div class="mt-4 sm:mt-6 container mx-auto px-4">
        <div class="bg-slate-800 rounded-lg border border-slate-700 shadow-lg transition-all duration-300 hover:shadow-xl">
            <div class="p-4 sm:p-6 space-y-6">
                <!-- Header with animation -->
                <div class="flex items-center justify-between border-b border-slate-700 pb-4">
                    <h3 class="text-xl font-semibold text-gray-200 flex items-center space-x-2">
                        <a href="{{ route('users.index') }}" class="text-slate-400 hover:text-slate-200 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                        </a>
                        <span>{{ $user->name }}'s Profile</span>
                        </a>
                        @if($user->profile?->verified)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                        @endif
                    </h3>
                    <a 
                        href="#" 
                        class="inline-flex items-center px-4 py-2 bg-slate-700 text-sm font-medium rounded-md text-gray-200 hover:bg-slate-600 transition-colors duration-200"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <!-- Basic Information -->
                        <div class="bg-slate-700/50 rounded-lg p-6 backdrop-blur-sm">
                            <h4 class="text-gray-200 font-medium mb-4 flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>Basic Information</span>
                            </h4>
                            <div class="space-y-4">
                                <div class="group">
                                    <p class="text-sm text-gray-400">Name</p>
                                    <p class="text-gray-200 font-medium group-hover:text-blue-400 transition-colors duration-200">{{ $user->name }}</p>
                                </div>
                                <div class="group">
                                    <p class="text-sm text-gray-400">Email</p>
                                    <p class="text-gray-200 font-medium group-hover:text-blue-400 transition-colors duration-200">{{ $user->email }}</p>
                                </div>
                                <div class="group">
                                    <p class="text-sm text-gray-400">Gender</p>
                                    <p class="text-gray-200 font-medium group-hover:text-blue-400 transition-colors duration-200">
                                        {{ ucfirst($user->profile?->gender ?? 'Not specified') }}
                                    </p>
                                </div>
                                <div class="group">
                                    <p class="text-sm text-gray-400">Phone</p>
                                    <p class="text-gray-200 font-medium group-hover:text-blue-400 transition-colors duration-200">{{ $user->profile?->phone_number ?? 'Not provided' }}</p>
                                </div>
                                <div class="group">
                                    <p class="text-sm text-gray-400">Member Since</p>
                                    <p class="text-gray-200 font-medium group-hover:text-blue-400 transition-colors duration-200">{{ $user->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Middle Column - Addresses -->
                    <div class="space-y-6">
                        <!-- Default Shipping Address -->
                        <div class="bg-slate-700/50 rounded-lg p-6 backdrop-blur-sm">
                            <h4 class="text-gray-200 font-medium mb-4 flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
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
                                    <p class="text-gray-400">No shipping address provided</p>
                                </div>
                            @endif
                        </div>

                        <!-- Default Billing Address -->
                        <div class="bg-slate-700/50 rounded-lg p-6 backdrop-blur-sm">
                            <h4 class="text-gray-200 font-medium mb-4 flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
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
                                    <p class="text-gray-400">No billing address provided</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Right Column - Additional Info -->
                    <div class="space-y-6">
                        <!-- Preferences -->
                        <div class="bg-slate-700/50 rounded-lg p-6 backdrop-blur-sm">
                            <h4 class="text-gray-200 font-medium mb-4 flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>Preferences</span>
                            </h4>
                            <div class="space-y-4">
                                <div class="group">
                                    <p class="text-sm text-gray-400">Newsletter</p>
                                   
                                    <div class="flex items-center space-x-2">
                                        <span class="text-gray-200 font-medium group-hover:text-blue-400 transition-colors duration-200">
                                            {{ $user->profile?->newsletter_subscribed ? 'Subscribed' : 'Not subscribed' }}
                                        </span>
                                        @if($user->profile?->newsletter_subscribed)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
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
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                <span>Account Statistics</span>
                            </h4>
                            <div class="grid grid-cols-2 gap-6">
                                <div class="bg-slate-800/50 rounded-lg p-4 group hover:bg-slate-800 transition-colors duration-200">
                                    <p class="text-sm text-gray-400">Total Orders</p>
                                    <div class="mt-2 flex items-end space-x-2">
                                        <p class="text-2xl font-bold text-gray-200 group-hover:text-blue-400 transition-colors duration-200">
                                            {{ $user->orders_count ?? 0 }}
                                        </p>
                                        @if(($user->orders_count ?? 0) > 0)
                                            <span class="text-xs text-green-400 mb-1">+{{ $user->orders_last_month ?? 0 }} last month</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="bg-slate-800/50 rounded-lg p-4 group hover:bg-slate-800 transition-colors duration-200">
                                    <p class="text-sm text-gray-400">Reviews</p>
                                    <div class="mt-2 flex items-end space-x-2">
                                        <p class="text-2xl font-bold text-gray-200 group-hover:text-blue-400 transition-colors duration-200">
                                            {{ $user->reviews_count ?? 0 }}
                                        </p>
                                        @if(($user->reviews_count ?? 0) > 0)
                                            <div class="flex items-center mb-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                                </svg>
                                                <span class="text-xs text-gray-400 ml-1">{{ number_format($user->average_rating ?? 0, 1) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="bg-slate-800/50 rounded-lg p-4 group hover:bg-slate-800 transition-colors duration-200">
                                    <p class="text-sm text-gray-400">Wishlist Items</p>
                                    <p class="mt-2 text-2xl font-bold text-gray-200 group-hover:text-blue-400 transition-colors duration-200">
                                        {{ $user->wishlist_count ?? 0 }}
                                    </p>
                                </div>
                                <div class="bg-slate-800/50 rounded-lg p-4 group hover:bg-slate-800 transition-colors duration-200">
                                    <p class="text-sm text-gray-400">Last Order</p>
                                    <p class="mt-2 text-gray-200 font-medium group-hover:text-blue-400 transition-colors duration-200">
                                        {{ $user->latest_order?->created_at?->format('M d, Y') ?? 'No orders yet' }}
                                    </p>
                                </div>
                                <div class="bg-slate-800/50 rounded-lg p-4 group hover:bg-slate-800 transition-colors duration-200">
                                    <p class="text-sm text-gray-400">Cart Items</p>
                                    <p class="mt-2 text-2xl font-bold text-gray-200 group-hover:text-blue-400 transition-colors duration-200">
                                        {{ $user->cart_count ?? 0 }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>