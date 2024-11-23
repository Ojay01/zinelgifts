<!-- resources/views/profile/edit.blade.php -->
<x-admin-layout>
    <div class="mt-4 sm:mt-6 container mx-auto px-4">
        <div class="bg-slate-800 rounded-lg border border-slate-700 shadow-lg">
            <div class="p-4 sm:p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-300">
                        Edit Profile
                    </h3>
                    <a 
                        href="{{ route('profile.user', $user) }}" 
                        class="text-slate-400 hover:text-slate-300 text-sm flex items-center space-x-1"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        <span>Back to Profile</span>
                    </a>
                </div>

                <form action="{{ route('profile.update', $user) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Left Column - Basic Info -->
                        <div class="space-y-6">
                            <!-- Avatar Upload -->
                            <div class="flex flex-col items-center space-y-4">
                                <div class="relative">
                                    @if($user->profile?->avatar)
                                        <img src="{{ Storage::url($user->profile->avatar) }}" 
                                             alt="{{ $user->name }}" 
                                             class="h-32 w-32 rounded-full object-cover border-2 border-slate-600">
                                    @else
                                        <div class="h-32 w-32 rounded-full bg-slate-700 flex items-center justify-center text-3xl text-gray-300">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <label class="absolute bottom-0 right-0 bg-slate-700 rounded-full p-2 cursor-pointer hover:bg-slate-600 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <input type="file" name="avatar" class="hidden" accept="image/*">
                                    </label>
                                </div>
                                @error('avatar')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Basic Information -->
                            <div class="bg-slate-700/50 rounded-lg p-4">
                                <h4 class="text-gray-300 font-medium mb-4">Basic Information</h4>
                                <div class="space-y-4">
                                    <div>
                                        <label class="text-sm text-gray-400">Name</label>
                                        <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                                               class="mt-1 block w-full rounded-md bg-slate-600 border-slate-500 text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                        @error('name')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="text-sm text-gray-400">Email</label>
                                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                               class="mt-1 block w-full rounded-md bg-slate-600 border-slate-500 text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                        @error('email')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="text-sm text-gray-400">Phone</label>
                                        <input type="tel" name="phone_number" value="{{ old('phone_number', $user->profile?->phone_number) }}"
                                               class="mt-1 block w-full rounded-md bg-slate-600 border-slate-500 text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                        @error('phone_number')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Middle Column - Addresses -->
                        <div class="space-y-6">
                            <!-- Shipping Address -->
                            <div class="bg-slate-700/50 rounded-lg p-4">
                                <h4 class="text-gray-300 font-medium mb-4">Shipping Address</h4>
                                <div class="space-y-4">
                                    <div>
                                        <label class="text-sm text-gray-400">Street Address</label>
                                        <input type="text" name="default_shipping_address" 
                                               value="{{ old('default_shipping_address', $user->profile?->default_shipping_address) }}"
                                               class="mt-1 block w-full rounded-md bg-slate-600 border-slate-500 text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="text-sm text-gray-400">City</label>
                                            <input type="text" name="city" value="{{ old('city', $user->profile?->city) }}"
                                                   class="mt-1 block w-full rounded-md bg-slate-600 border-slate-500 text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                        </div>
                                        <div>
                                            <label class="text-sm text-gray-400">State</label>
                                            <input type="text" name="state" value="{{ old('state', $user->profile?->state) }}"
                                                   class="mt-1 block w-full rounded-md bg-slate-600 border-slate-500 text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="text-sm text-gray-400">Postal Code</label>
                                            <input type="text" name="postal_code" value="{{ old('postal_code', $user->profile?->postal_code) }}"
                                                   class="mt-1 block w-full rounded-md bg-slate-600 border-slate-500 text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                        </div>
                                        <div>
                                            <label class="text-sm text-gray-400">Country</label>
                                            <input type="text" name="country" value="{{ old('country', $user->profile?->country) }}"
                                                   class="mt-1 block w-full rounded-md bg-slate-600 border-slate-500 text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Billing Address -->
                            <div class="bg-slate-700/50 rounded-lg p-4">
                                <div class="flex items-center justify-between mb-4">
                                    <h4 class="text-gray-300 font-medium">Billing Address</h4>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="same_as_shipping" class="rounded bg-slate-600 border-slate-500 text-indigo-600 focus:ring-indigo-500">
                                        <span class="ml-2 text-sm text-gray-400">Same as shipping</span>
                                    </label>
                                </div>
                                <div class="space-y-4">
                                    <div>
                                        <label class="text-sm text-gray-400">Street Address</label>
                                        <input type="text" name="default_billing_address" 
                                               value="{{ old('default_billing_address', $user->profile?->default_billing_address) }}"
                                               class="mt-1 block w-full rounded-md bg-slate-600 border-slate-500 text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="text-sm text-gray-400">City</label>
                                            <input type="text" name="billing_city" value="{{ old('billing_city', $user->profile?->billing_city) }}"
                                                   class="mt-1 block w-full rounded-md bg-slate-600 border-slate-500 text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                        </div>
                                        <div>
                                            <label class="text-sm text-gray-400">State</label>
                                            <input type="text" name="billing_state" value="{{ old('billing_state', $user->profile?->billing_state) }}"
                                                   class="mt-1 block w-full rounded-md bg-slate-600 border-slate-500 text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="text-sm text-gray-400">Postal Code</label>
                                            <input type="text" name="billing_postal_code" value="{{ old('billing_postal_code', $user->profile?->billing_postal_code) }}"
                                                   class="mt-1 block w-full rounded-md bg-slate-600 border-slate-500 text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                        </div>
                                        <div>
                                            <label class="text-sm text-gray-400">Country</label>
                                            <input type="text" name="billing_country" value="{{ old('billing_country', $user->profile?->billing_country) }}"
                                                   class="mt-1 block w-full rounded-md bg-slate-600 border-slate-500 text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Preferences -->
                        <div class="space-y-6">
                            <!-- Preferences -->
                            <div class="bg-slate-700/50 rounded-lg p-4">
                                <h4 class="text-gray-300 font-medium mb-4">Preferences</h4>
                                <div class="space-y-4">
                                    <div>
                                        <label class="flex items-center">
                                            <input type="checkbox" name="newsletter_subscribed" 
                                                   {{ $user->profile?->newsletter_subscribed ? 'checked' : '' }}
                                                   class="rounded bg-slate-600 border-slate-500 text-indigo-600 focus:ring-indigo-500">
                                            <span class="ml-2 text-sm text-gray-300">Subscribe to newsletter</span>
                                        </label>
                                    </div>
                                    @if($user->profile?->preferences)
                                        @foreach($user->profile->preferences as $key => $value)
                                            <div>
                                                <label class="text-sm text-gray-400">{{ ucfirst($key) }}</label>
                                                <input type="text" name="preferences[{{ $key }}]" value="{{ $value }}"
                                                       class="mt-1 block w-full rounded-md bg-slate-600 border-slate-500 text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <!-- Password Change -->
                            <div class="bg-slate-700/50 rounded-lg p-4">
                                <h4 class="text-gray-300 font-medium mb-4">Change Password</h4>
                                <div class="space-y-4">
                                    <div>
                                        <label class="text-sm text-gray-400">Current Password</label>
                                        <input type="password" name="current_password"
                                               class="mt-1 block w-full rounded-md bg-slate-600 border-slate-500 text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                        @error('current_password')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="text-sm text-gray-400">New Password</label>
                                        <input type="password" name="password"
                                        class="mt-1 block w-full rounded-md bg-slate-600 border-slate-500 text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                        @error('password')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="text-sm text-gray-400">Confirm New Password</label>
                                        <input type="password" name="password_confirmation"
                                               class="mt-1 block w-full rounded-md bg-slate-600 border-slate-500 text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Account -->
                            <div class="bg-slate-700/50 rounded-lg p-4">
                                <h4 class="text-red-400 font-medium mb-4">Danger Zone</h4>
                                <button type="button"
                                        onclick="confirm('Are you sure you want to delete your account? This action cannot be undone.') && document.getElementById('delete-account-form').submit()"
                                        class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md transition">
                                    Delete Account
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Save Button -->
                    <div class="flex justify-end pt-6">
                        <button type="submit" 
                                class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md transition flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Save Changes</span>
                        </button>
                    </div>
                </form>

                <!-- Delete Account Form -->
                <form id="delete-account-form" action="{{ route('profile.destroy', $user) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>


    <script>
        // Handle "Same as shipping" checkbox
        document.querySelector('input[name="same_as_shipping"]').addEventListener('change', function(e) {
            const billingInputs = [
                'default_billing_address',
                'billing_city',
                'billing_state',
                'billing_postal_code',
                'billing_country'
            ];
            const shippingInputs = [
                'default_shipping_address',
                'city',
                'state',
                'postal_code',
                'country'
            ];
            
            if (e.target.checked) {
                billingInputs.forEach((input, index) => {
                    document.querySelector(`input[name="${input}"]`).value = 
                        document.querySelector(`input[name="${shippingInputs[index]}"]`).value;
                });
            }
        });

        // Handle avatar preview
        document.querySelector('input[name="avatar"]').addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.querySelector('img') || document.createElement('img');
                    img.src = e.target.result;
                    img.alt = "Preview";
                    img.className = "h-32 w-32 rounded-full object-cover border-2 border-slate-600";
                    
                    const initialAvatar = document.querySelector('.h-32.w-32.rounded-full.bg-slate-700');
                    if (initialAvatar) {
                        initialAvatar.replaceWith(img);
                    }
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    </script>
</x-admin-layout>