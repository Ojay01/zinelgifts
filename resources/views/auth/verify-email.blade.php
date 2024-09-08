<x-guest-layout>
    <x-header />

    <div class="bg-gray-100 dark:bg-gray-900 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-xl overflow-hidden">
            <div class="py-8 px-6 sm:px-10">
                <h2 class="text-center text-3xl font-extrabold text-gray-900 dark:text-white mb-6">
                    {{ __('Email Verification') }}
                    </h2>   <div class="w-24 h-1 bg-yellow-500 mx-auto mb-8"></div>                <!-- Message -->
                <div class="mb-4 text-sm text-gray-600 dark:text-gray-300">
                    {{ __('Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </div>

                <!-- Status Message -->
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                        {{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}
                    </div>
                @endif

                <!-- Form Section -->
                <div class="mt-4 flex flex-col items-center justify-between">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <!-- Resend Verification Button -->
                        <x-button class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-md transition duration-300">
                            {{ __('Resend Verification Email') }}
                        </x-button>
                    </form>

                    <!-- Edit Profile and Logout Links -->
                    <div class="flex items-center space-x-4">
                        <!-- Edit Profile -->
                        <a href="{{ route('profile.show') }}"
                            class="text-sm text-yellow-500 dark:text-yellow-400 hover:underline transition-colors duration-300">
                            {{ __('Edit Profile') }}
                        </a>

                        <!-- Logout Button -->
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                class="text-sm text-gray-600 dark:text-gray-300 hover:text-yellow-500 dark:hover:text-yellow-400 underline transition-colors duration-300">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-footer />
</x-guest-layout>
