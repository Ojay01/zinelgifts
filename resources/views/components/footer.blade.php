<!-- resources/views/components/footer.blade.php -->
<footer class="bg-gray-200 dark:bg-black text-gray-800 dark:text-yellow-500 py-12 transition-colors duration-300">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- About Us Column -->
            <div>
                <h3 class="text-2xl font-bold mb-4 text-yellow-500 dark:text-yellow-400">About Us</h3>
                <p class="text-gray-600 dark:text-yellow-400/70 mb-4">ZINEL is a gift shop created to help every individual easily get perfectly customized/personalized gift products every time, and anywhere for any occasion or ceremony.</p>
                <div class="flex space-x-4">
                    <a href="https://www.facebook.com/zinelgiftshop" class="text-gray-600 dark:text-yellow-500 hover:text-yellow-500 dark:hover:text-yellow-400 transition-colors duration-300">
                        <i class="fab fa-facebook-f text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-600 dark:text-yellow-500 hover:text-yellow-500 dark:hover:text-yellow-400 transition-colors duration-300">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="https://wa.me/237674199990" class="text-gray-600 dark:text-yellow-500 hover:text-yellow-500 dark:hover:text-yellow-400 transition-colors duration-300">
                        <i class="fab fa-whatsapp text-yellow-500 mr-3 text-xl"></i>
                    </a>
                </div>
            </div>

            <!-- Useful Links Column -->
            <div>
                <h3 class="text-2xl font-bold mb-4 text-yellow-500 dark:text-yellow-400">Useful Links</h3>
                <ul class="space-y-2">
                    <li><a href="{{route('about.us')}} " class="text-gray-600 dark:text-yellow-400/70 hover:text-yellow-500 dark:hover:text-yellow-300 transition-colors duration-300">About Us</a></li>
                    <li><a href="{{route('team')}} " class="text-gray-600 dark:text-yellow-400/70 hover:text-yellow-500 dark:hover:text-yellow-300 transition-colors duration-300">Our Team</a></li>
                    <li><a href="{{route('services')}} " class="text-gray-600 dark:text-yellow-400/70 hover:text-yellow-500 dark:hover:text-yellow-300 transition-colors duration-300">Our Services</a></li>
                    <li><a href="#" class="text-gray-600 dark:text-yellow-400/70 hover:text-yellow-500 dark:hover:text-yellow-300 transition-colors duration-300">Terms of Service</a></li>
                    <li><a href="#" class="text-gray-600 dark:text-yellow-400/70 hover:text-yellow-500 dark:hover:text-yellow-300 transition-colors duration-300">Privacy Policy</a></li>
                    <li><a href="{{route('contact')}} " class="text-gray-600 dark:text-yellow-400/70 hover:text-yellow-500 dark:hover:text-yellow-300 transition-colors duration-300">Contact Us</a></li>
                </ul>
            </div>

            <!-- Customer Service Column -->
            <div>
                <h3 class="text-2xl font-bold mb-4 text-yellow-500 dark:text-yellow-400">Customer Service</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-600 dark:text-yellow-400/70 hover:text-yellow-500 dark:hover:text-yellow-300 transition-colors duration-300">My Account</a></li>
                    <li><a href="#" class="text-gray-600 dark:text-yellow-400/70 hover:text-yellow-500 dark:hover:text-yellow-300 transition-colors duration-300">Order Tracking</a></li>
                    <li><a href="#" class="text-gray-600 dark:text-yellow-400/70 hover:text-yellow-500 dark:hover:text-yellow-300 transition-colors duration-300">Returns & Exchanges</a></li>
                    <li><a href="#" class="text-gray-600 dark:text-yellow-400/70 hover:text-yellow-500 dark:hover:text-yellow-300 transition-colors duration-300">Shipping Information</a></li>
                </ul>
            </div>

            <!-- Newsletter Column -->
            <div>
                <h3 class="text-2xl font-bold mb-4 text-yellow-500 dark:text-yellow-400">Newsletter</h3>
                <p class="text-gray-600 dark:text-yellow-400/70 mb-4">Subscribe to our newsletter for updates on new products and special offers.</p>
                <form class="flex">
                    <input type="email" placeholder="Your email address" class="flex-grow px-4 py-2 rounded-l-full focus:outline-none focus:ring-2 focus:ring-yellow-500 bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-white transition-colors duration-300">
                    <button type="submit" class="bg-yellow-500 text-white  px-6 py-2 rounded-r-full hover:bg-yellow-600 transition-colors duration-300">Subscribe</button>
                </form>
            </div>
        </div>

        <div class="mt-12 pt-8 border-t border-gray-200 dark:border-yellow-800">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-600 dark:text-yellow-400/70">&copy; 2024 Zinel Gifts. All rights reserved.</p>
                <div class="mt-4 md:mt-0 flex items-center space-x-4">
                    <span class="text-gray-600 dark:text-yellow-400/70">We accept:</span>
                    <img src="{{ asset('path/to/payment-methods.png') }}" alt="Payment Methods" class="h-8">
                </div>
            </div>
        </div>
    </div>
</footer>