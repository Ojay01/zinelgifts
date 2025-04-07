<!-- resources/views/admin/users/edit.blade.php -->
<x-admin-layout>
    <div class="mt-6 sm:mt-8 container mx-auto px-4">
        <div class="bg-slate-800 rounded-xl border border-slate-700 shadow-xl">
            <div class="p-5 sm:p-7 space-y-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-user-edit mr-2 text-blue-400"></i>
                        Edit User: {{ $user->name }}
                    </h3>
                    <a 
                        href="{{ route('users.index') }}" 
                        class="text-slate-400 hover:text-slate-300 transition-colors flex items-center space-x-2 bg-slate-700 px-3 py-1.5 rounded-lg hover:bg-slate-600"
                    >
                        <i class="fas fa-arrow-left text-sm"></i>
                        <span>Back to Users</span>
                    </a>
                </div>

                <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-4">
                        <!-- Name -->
                        <div class="bg-slate-700/30 p-5 rounded-lg border border-slate-700/50">
                            <label for="name" class="block text-sm font-medium text-gray-300 flex items-center">
                                <i class="fas fa-user mr-2 text-gray-500"></i>
                                Name
                            </label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                value="{{ old('name', $user->name) }}"
                                class="mt-2 w-full px-3 py-2 bg-slate-800 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-300"
                                required
                            >
                            @error('name')
                                <p class="mt-1 text-sm text-red-400 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="bg-slate-700/30 p-5 rounded-lg border border-slate-700/50">
                            <label for="email" class="block text-sm font-medium text-gray-300 flex items-center">
                                <i class="fas fa-envelope mr-2 text-gray-500"></i>
                                Email
                            </label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                value="{{ old('email', $user->email) }}"
                                class="mt-2 w-full px-3 py-2 bg-slate-800 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-300"
                                required
                            >
                            @error('email')
                                <p class="mt-1 text-sm text-red-400 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="bg-slate-700/30 p-5 rounded-lg border border-slate-700/50">
                            <label for="password" class="block text-sm font-medium text-gray-300 flex items-center">
                                <i class="fas fa-lock mr-2 text-gray-500"></i>
                                New Password
                                <span class="ml-2 text-slate-400 text-xs">(leave blank to keep current password)</span>
                            </label>
                            <div class="relative mt-2">
                                <input 
                                    type="password" 
                                    name="password" 
                                    id="password"
                                    class="w-full px-3 py-2 bg-slate-800 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-300 pr-10"
                                >
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <i class="fas fa-eye-slash text-gray-500 cursor-pointer" id="togglePassword"></i>
                                </div>
                            </div>
                            @error('password')
                                <p class="mt-1 text-sm text-red-400 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Password Confirmation -->
                        <div class="bg-slate-700/30 p-5 rounded-lg border border-slate-700/50">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-300 flex items-center">
                                <i class="fas fa-check-circle mr-2 text-gray-500"></i>
                                Confirm New Password
                            </label>
                            <div class="relative mt-2">
                                <input 
                                    type="password" 
                                    name="password_confirmation" 
                                    id="password_confirmation"
                                    class="w-full px-3 py-2 bg-slate-800 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-300 pr-10"
                                >
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <i class="fas fa-eye-slash text-gray-500 cursor-pointer" id="toggleConfirmPassword"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Created At (Read-only) -->
                        <div class="bg-slate-700/30 p-5 rounded-lg border border-slate-700/50">
                            <label class="block text-sm font-medium text-gray-300 flex items-center">
                                <i class="fas fa-calendar-alt mr-2 text-gray-500"></i>
                                Joined Date
                            </label>
                            <p class="mt-2 text-gray-400 pl-2 border-l-2 border-blue-500">
                                {{ $user->created_at->format('M d, Y') }}
                            </p>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-3 pt-6 border-t border-slate-700">
                        <a 
                            href="{{ route('users.index') }}"
                            class="px-4 py-2 bg-slate-700 text-gray-300 rounded-lg hover:bg-slate-600 transition-colors flex items-center"
                        >
                            <i class="fas fa-times mr-2"></i>
                            Cancel
                        </a>
                        <button 
                            type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center"
                        >
                            <i class="fas fa-save mr-2"></i>
                            Update User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            const togglePassword = document.getElementById('togglePassword');
            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('password_confirmation');
            
            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
            
            toggleConfirmPassword.addEventListener('click', function() {
                const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPassword.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });
    </script>
</x-admin-layout>