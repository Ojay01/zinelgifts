@extends('profile.index')

@section('profile-content')
<div class="space-y-6 max-w-4xl mx-auto">
    <!-- Basic Information -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 mb-4 relative">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-yellow-500">Profile Information</h2>
            <button class="text-yellow-500 hover:text-yellow-600 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                </svg>
            </button>
        </div>
        
        <form action="{{route('profile.updateProfile')}}" method="POST" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-gray-700 dark:text-gray-300 mb-2 font-medium">Full Name</label>
                    <input type="text" id="firstName" name="name" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-3 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white transition duration-300" 
                           value="{{ old('name', auth()->user()->name) }}" required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-gray-700 dark:text-gray-300 mb-2 font-medium">Email Address</label>
                    <input type="email" id="email" name="email" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-3 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white transition duration-300" 
                           value="{{ old('email', auth()->user()->email) }}" required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block text-gray-700 dark:text-gray-300 mb-2 font-medium">Phone Number</label>
                    <input type="tel" id="phone" name="number" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-3 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white transition duration-300" 
                           value="{{ old('phone', auth()->user()->number) }}">
                    @error('number')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="bio" class="block text-gray-700 dark:text-gray-300 mb-2 font-medium">Bio <small class="text-gray-500"> (Special needs, what we need to know)</small></label>
                <textarea id="bio" name="bio" rows="4" 
                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-3 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white transition duration-300">{{ old('bio', auth()->user()->bio) }}</textarea>
                @error('bio')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="text-right">
                <button type="submit" class="bg-yellow-500 text-white px-8 py-3 rounded-xl hover:bg-yellow-600 transition duration-300 shadow-md hover:shadow-lg">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <!-- Password Change Section -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8 relative">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-3xl font-bold text-gray-800 dark:text-yellow-500">Change Password</h2>
            <button class="text-yellow-500 hover:text-yellow-600 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
            </button>
        </div>
        
        <form action="{{route('profile.updatePassword')}}" method="POST" class="space-y-6">
            @csrf
            
            <div class="space-y-6">
                <div>
                    <label for="current_password" class="block text-gray-700 dark:text-gray-300 mb-2 font-medium">Current Password</label>
                    <input type="password" id="current_password" name="current_password" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-3 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white transition duration-300" 
                           required>
                    @error('current_password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-gray-700 dark:text-gray-300 mb-2 font-medium">New Password</label>
                    <input type="password" id="password" name="password" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-3 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white transition duration-300" 
                           required>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-gray-700 dark:text-gray-300 mb-2 font-medium">Confirm New Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-3 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white transition duration-300" 
                           required>
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-yellow-500 text-white px-8 py-3 rounded-xl hover:bg-yellow-600 transition duration-300 shadow-md hover:shadow-lg">
                    Update Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection