<!-- resources/views/components/footer.blade.php -->
<footer class="bg-black text-yellow-500 py-12">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- About Us Column -->
            <div>
                <h3 class="text-xl font-bold mb-4">About Us</h3>
                <p class="text-yellow-400 mb-4">We are dedicated to providing high-quality furniture and home decor to make your living spaces beautiful and comfortable.</p>
                <div class="flex space-x-4">
                    <a href="#" class="text-yellow-500 hover:text-yellow-400"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-yellow-500 hover:text-yellow-400"><i class="fab fa-instagram"></i></a>
                </div>
            </div>

            <!-- Useful Links Column -->
            <div>
                <h3 class="text-xl font-bold mb-4">Useful Links</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-yellow-400 hover:text-yellow-300">About Us</a></li>
                    <li><a href="#" class="text-yellow-400 hover:text-yellow-300">FAQs</a></li>
                    <li><a href="#" class="text-yellow-400 hover:text-yellow-300">Terms of Service</a></li>
                    <li><a href="#" class="text-yellow-400 hover:text-yellow-300">Privacy Policy</a></li>
                    <li><a href="#" class="text-yellow-400 hover:text-yellow-300">Contact Us</a></li>
                </ul>
            </div>

            <!-- Customer Service Column -->
            <div>
                <h3 class="text-xl font-bold mb-4">Customer Service</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-yellow-400 hover:text-yellow-300">My Account</a></li>
                    <li><a href="#" class="text-yellow-400 hover:text-yellow-300">Order Tracking</a></li>
                    <li><a href="#" class="text-yellow-400 hover:text-yellow-300">Returns & Exchanges</a></li>
                    <li><a href="#" class="text-yellow-400 hover:text-yellow-300">Shipping Information</a></li>
                </ul>
            </div>

            <!-- Newsletter Column -->
            <div>
                <h3 class="text-xl font-bold mb-4">Newsletter</h3>
                <p class="text-yellow-400 mb-4">Subscribe to our newsletter for updates on new products and special offers.</p>
                <form class="flex">
                    <input type="email" placeholder="Your email address" class="flex-grow px-4 py-2 rounded-l-full focus:outline-none focus:ring-2 focus:ring-yellow-500 bg-gray-800 text-white">
                    <button type="submit" class="bg-yellow-500 text-black px-4 py-2 rounded-r-full hover:bg-yellow-400 transition duration-300">Subscribe</button>
                </form>
            </div>
        </div>

        <div class="mt-8 pt-8 border-t border-yellow-800">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-yellow-400">&copy; 2024 Zinel Gifts. All rights reserved.</p>
                <div class="mt-4 md:mt-0">
                    <img src="{{ asset('path/to/payment-methods.png') }}" alt="Payment Methods" class="h-8">
                </div>
            </div>
        </div>
    </div>
</footer>