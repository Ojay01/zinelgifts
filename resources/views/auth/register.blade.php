<x-guest-layout>
    <x-header />
    <div class="bg-gray-100 dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-xl overflow-hidden">
            <div class="py-8 px-6 sm:px-10">
                <h2 class="text-center text-3xl font-extrabold text-gray-900 dark:text-white mb-6">
                    Create your account
                </h2>

                <form class="space-y-6" action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <!-- Full Name Input -->
                        <div class="relative">
                            <label for="name" class="sr-only">Full name</label>
                            <input id="name" name="name" type="text" required value="{{ old('name') }}"
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white dark:bg-gray-700 placeholder-gray-500 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm transition duration-150 ease-in-out"
                                placeholder="Full name">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Email Input -->
                        <div class="relative">
                            <label for="email-address" class="sr-only">Email address</label>
                            <input id="email-address" name="email" type="email" required value="{{ old('email') }}"
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white dark:bg-gray-700 placeholder-gray-500 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm transition duration-150 ease-in-out"
                                placeholder="Email address">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Password Input -->
                        <div class="relative">
                            <label for="password" class="sr-only">Password</label>
                            <input id="password" name="password" type="password" required
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white dark:bg-gray-700 placeholder-gray-500 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm transition duration-150 ease-in-out"
                                placeholder="Password">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Password Confirmation Input -->
                        <div class="relative">
                            <label for="password_confirmation" class="sr-only">Confirm password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" required
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white dark:bg-gray-700 placeholder-gray-500 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm transition duration-150 ease-in-out"
                                placeholder="Confirm password">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                        </div>

                        <!-- Terms and Conditions Checkbox -->
                        <div class="relative flex items-start">
                            <div class="flex items-center h-5">
                                <input id="terms" name="terms" type="checkbox" class="focus:ring-yellow-500 h-4 w-4 text-yellow-600 border-gray-300 rounded"
                                    {{ old('terms') ? 'checked' : '' }} required>
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="terms" class="font-medium text-gray-700 dark:text-gray-300">
                                    I agree to the
                                    <a href="{{ route('terms') }}" class="text-yellow-600 hover:text-yellow-500">Terms and Conditions</a>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition duration-150 ease-in-out">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <i class="fas fa-user-plus text-yellow-500 group-hover:text-yellow-400"></i>
                            </span>
                            Create Account
                        </button>
                    </div>
                </form>

                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white dark:bg-gray-800 text-gray-500">Or register with</span>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-2 gap-3">
                        <a href="{{ route('social.login', 'google') }}" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition duration-150 ease-in-out">
                            <i class="fab fa-google text-red-500 mr-2"></i>
                            Google
                        </a>
                        <a href="{{ route('social.login', 'facebook') }}" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition duration-150 ease-in-out">
                            <i class="fab fa-facebook text-blue-600 mr-2"></i>
                            Facebook
                        </a>
                    </div>
                </div>

                <p class="mt-6 text-center text-sm text-gray-600 dark:text-gray-400">
                    Already have an account?
                    <a href="{{ route('login') }}" class="font-medium text-yellow-600 hover:text-yellow-500 transition duration-150 ease-in-out">
                        Sign in
                    </a>
                </p>
            </div>
        </div>
    </div>
    <x-footer />
</x-guest-layout>
