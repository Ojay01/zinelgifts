<x-guest-layout>
    <x-header />

    <div class="bg-gray-100 dark:bg-gray-900 py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold text-center text-gray-800 dark:text-yellow-500 mb-4">Contact Us</h1>
            <div class="w-24 h-1 bg-yellow-500 mx-auto mb-12"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-yellow-500 mb-6">Send us a message</h2>
                    <form id="contact-form" action="{{ route('contact.send') }}" method="POST" onsubmit="handleFormSubmit(event)">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 dark:text-gray-300 mb-2">Name</label>
                            <input type="text" id="name" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 dark:text-gray-300 mb-2">Email</label>
                            <input type="email" id="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                        </div>
                        <div class="mb-4">
                            <label for="message" class="block text-gray-700 dark:text-gray-300 mb-2">Message</label>
                            <textarea id="message" name="message" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required></textarea>
                        </div>
                        <button id="submit-button" type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded-md hover:bg-yellow-600 transition duration-300 flex items-center">
                            <span id="button-text">Send Message</span>
                            <i id="spinner" class="fas fa-spinner fa-spin !hidden ml-2"></i>
                        </button>
                    </form>
                </div>

                <!-- Contact Details -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-yellow-500 mb-6">24/7 Support Services</h2>
                    <ul class="space-y-4">
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt text-yellow-500 mr-3 text-xl"></i>
                            <span class="text-gray-700 dark:text-gray-300">Location: Cameroon</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt text-yellow-500 mr-3 text-xl"></i>
                            <a href="tel:+237674199990" class="text-gray-700 dark:text-gray-300 hover:text-yellow-500 dark:hover:text-yellow-400">Telephone: +237 674 199 990</a>
                        </li>
                        <li class="flex items-center">
                            <i class="fab fa-whatsapp text-yellow-500 mr-3 text-xl"></i>
                            <a href="https://wa.me/237674199990" target="_blank" rel="noopener noreferrer" class="text-gray-700 dark:text-gray-300 hover:text-yellow-500 dark:hover:text-yellow-400">WhatsApp: 674 199 990</a>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope text-yellow-500 mr-3 text-xl"></i>
                            <a href="mailto:support@zinelgifts.com" class="text-gray-700 dark:text-gray-300 hover:text-yellow-500 dark:hover:text-yellow-400">Email: support@zinelgifts.com</a>
                        </li>
                        <li class="flex items-center">
                            <i class="fab fa-facebook-f text-yellow-500 mr-3 text-xl"></i>
                            <a href="https://www.facebook.com/zinelgiftshop" target="_blank" rel="noopener noreferrer" class="text-gray-700 dark:text-gray-300 hover:text-yellow-500 dark:hover:text-yellow-400">Facebook: @zinelgiftshop</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Map (Optional) -->
            <div class="mt-12">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-yellow-500 mb-6">Find Us</h2>
                <div class="aspect-w-16 aspect-h-9">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1015024.1881829754!2d9.684755586754456!3d4.121344940390882!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x10613753703e0f21%3A0x2b03c44599829b53!2sCameroon!5e0!3m2!1sen!2sus!4v1653664410345!5m2!1sen!2sus" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>

    <x-footer />

    <script>
        function handleFormSubmit(event) {
            event.preventDefault(); // Prevent default form submission behavior
            
            const submitButton = document.getElementById('submit-button');
            const buttonText = document.getElementById('button-text');
            const spinner = document.getElementById('spinner');

            // Show spinner only after form submission
            submitButton.disabled = true;
            buttonText.classList.add('disabled'); // Hide the text
            spinner.classList.remove('!hidden'); // Show the spinner

            // Simulate form submission
            event.target.submit();  // Proceed with form submission
        }
    </script>
</x-guest-layout>
