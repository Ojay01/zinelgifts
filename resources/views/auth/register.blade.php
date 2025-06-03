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

                        <!-- Google reCAPTCHA -->
                        <div class="flex justify-center">
                            <div class="g-recaptcha" 
                                 data-sitekey="6LcJ8FMrAAAAAKjonoFcERNSL1vJPC6-Z62teBrz"
                                 data-callback="onRecaptchaSuccess"
                                 data-expired-callback="onRecaptchaExpired"></div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button id="submit-button" type="submit" disabled class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gray-400 cursor-not-allowed transition duration-150 ease-in-out disabled:bg-gray-400 disabled:cursor-not-allowed enabled:bg-yellow-600 enabled:hover:bg-yellow-700 enabled:cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <i id="submit-icon" class="fas fa-user-plus text-gray-300"></i>
                            </span>
                            <span id="submit-text">Verify to Continue</span>
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

    <!-- Google reCAPTCHA Script -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    
    <script>
        // reCAPTCHA callback functions
        function onRecaptchaSuccess() {
            console.log('reCAPTCHA completed successfully');
            const submitButton = document.getElementById('submit-button');
            const submitIcon = document.getElementById('submit-icon');
            const submitText = document.getElementById('submit-text');
            
            // Enable the submit button
            submitButton.disabled = false;
            submitButton.classList.remove('bg-gray-400', 'cursor-not-allowed');
            submitButton.classList.add('bg-yellow-600', 'hover:bg-yellow-700', 'cursor-pointer');
            
            // Update icon styling
            submitIcon.classList.remove('text-gray-300');
            submitIcon.classList.add('text-yellow-500', 'group-hover:text-yellow-400');
            
            // Update button text
            submitText.textContent = 'Create Account';
        }
        
        function onRecaptchaExpired() {
            console.log('reCAPTCHA expired');
            const submitButton = document.getElementById('submit-button');
            const submitIcon = document.getElementById('submit-icon');
            const submitText = document.getElementById('submit-text');
            
            // Disable the submit button
            submitButton.disabled = true;
            submitButton.classList.remove('bg-yellow-600', 'hover:bg-yellow-700', 'cursor-pointer');
            submitButton.classList.add('bg-gray-400', 'cursor-not-allowed');
            
            // Update icon styling
            submitIcon.classList.remove('text-yellow-500', 'group-hover:text-yellow-400');
            submitIcon.classList.add('text-gray-300');
            
            // Update button text
            submitText.textContent = 'Verify to Continue';
        }
        
        // Optional: Handle form submission to double-check reCAPTCHA
        document.querySelector('form').addEventListener('submit', function(e) {
            const recaptchaResponse = grecaptcha.getResponse();
            if (!recaptchaResponse) {
                e.preventDefault();
                alert('Please complete the reCAPTCHA verification.');
                return false;
            }
        });

        // Debug: Check if reCAPTCHA loaded properly
        window.addEventListener('load', function() {
            console.log('Page loaded, reCAPTCHA should be available');
        });
    </script>

    <x-footer />
</x-guest-layout>