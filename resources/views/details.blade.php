<!-- resources/views/product-detail.blade.php -->
<x-guest-layout>
    <x-header />

    <div class="bg-gray-100 dark:bg-gray-900 py-16">
        <div class="container mx-auto px-4">
            <!-- Breadcrumb -->
            <nav class="text-sm mb-6">
                <ol class="list-none p-0 inline-flex">
                    <li class="flex items-center text-gray-600 dark:text-gray-400">
                        <a href="#" class="hover:text-yellow-500">Home</a>
                        <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                    </li>
                    <li class="flex items-center text-gray-600 dark:text-gray-400">
                        <a href="#" class="hover:text-yellow-500">Shop</a>
                        <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                    </li>
                    <li class="flex items-center text-yellow-500">Product Name</li>
                </ol>
            </nav>

            <div class="flex flex-col lg:flex-row gap-12">
                <!-- Product Images -->
                <div class="w-full lg:w-1/2">
                    <!-- Main Image with Zoom -->
                    <div class="relative mb-4">
                        <div class="overflow-hidden" id="image-zoom-container">
                            <img id="main-image" src="https://via.placeholder.com/600x600" alt="Product Image" class="w-full h-auto rounded-lg shadow-lg transition-transform duration-300 transform scale-100">
                        </div>
                    </div>

                    <!-- Thumbnails -->
                    <div class="flex gap-2 justify-center" id="thumbnails">
                        <img src="https://via.placeholder.com/600x600" id="original-image" alt="Original Product Image" class="thumbnail w-12 h-12 md:!w-20 md:!h-20 rounded-lg shadow cursor-pointer border-2 border-transparent hover:opacity-75 transition-opacity duration-300" onclick="changeMainImage(this, this.src)">
                        @for ($i = 1; $i <= 5; $i++)
                        <img src="https://via.placeholder.com/120x120" alt="Product Image {{ $i }}" class="thumbnail w-12 h-12 md:!w-20 md:!h-20  rounded-lg shadow cursor-pointer border-2 border-transparent hover:opacity-75 transition-opacity duration-300" onclick="changeMainImage(this, this.src)">
                        @endfor
                    </div>
                </div>

                <!-- Product Details -->
                <div class="w-full lg:w-1/2">
                    <h1 class="text-3xl font-bold mb-4 text-gray-800 dark:text-white">Custom T-Shirt</h1>
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400 mr-2">
                            @for ($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star"></i>
                            @endfor
                        </div>
                        <span class="text-gray-600 dark:text-gray-400">(42 reviews)</span>
                    </div>
                    <p class="text-2xl font-bold text-yellow-500 dark:text-yellow-400 mb-4">₣29.99 <span class="text-sm text-gray-500 line-through ml-2">₣39.99</span></p>
                    <p class="text-gray-600 dark:text-gray-300 mb-6">High-quality custom printed t-shirt. Available in various sizes and colors.</p>

                    <!-- Size Selection -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2 text-gray-700 dark:text-gray-300">Size</h3>
                        <div class="flex space-x-3">
                            @foreach(['S', 'M', 'L', 'XL', 'XXL'] as $size)
                            <button class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-300 hover:bg-yellow-500 hover:text-white transition-colors duration-300">{{ $size }}</button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Color Selection -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2 text-gray-700 dark:text-gray-300">Color</h3>
                        <div class="flex space-x-3">
                            @foreach(['bg-red-500', 'bg-blue-500', 'bg-green-500', 'bg-yellow-500', 'bg-purple-500'] as $color)
                            <button class="w-8 h-8 rounded-full {{ $color }} border-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500"></button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Add to Cart -->
                    <div class="flex items-center mb-6">
                        <div class="mr-4">
                            <label for="quantity" class="sr-only">Quantity</label>
                            <input type="number" id="quantity" name="quantity" min="1" value="1" class="w-16 px-3 py-2 border border-gray-300 rounded-md text-gray-700 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        </div>
                        <button class="flex-grow bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-md transition-colors duration-300">
                            Add to Cart
                        </button>
                    </div>

                    <!-- Product Meta -->
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                        <p class="text-gray-600 dark:text-gray-400 mb-2"><span class="font-semibold text-gray-700 dark:text-gray-300">Category:</span> T-Shirts</p>
                        <p class="text-gray-600 dark:text-gray-400 mb-2"><span class="font-semibold text-gray-700 dark:text-gray-300">Tags:</span> Custom, Fashion, Summer</p>
                        <p class="text-gray-600 dark:text-gray-400"><span class="font-semibold text-gray-700 dark:text-gray-300">SKU:</span> TSH001</p>
                    </div>
                </div>
            </div>

            <!-- Product Information Tabs -->
            <div class="mt-16">
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <nav class="-mb-px flex space-x-8">
                        <a href="#" class="border-yellow-500 text-yellow-500 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" onclick="showTab('description')">
                            Description
                        </a>
                        <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" onclick="showTab('additional-info')">
                            Additional Information
                        </a>
                        <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" onclick="showTab('reviews')">
                            Reviews
                        </a>
                    </nav>
                </div>

                <!-- Tab Content -->
                <div id="description" class="py-6">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Product Description</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">Our custom t-shirts are made from high-quality, 100% cotton fabric that's soft, comfortable, and breathable. Perfect for everyday wear or special occasions, these shirts can be customized with your own designs, text, or images.</p>
                    <ul class="list-disc list-inside text-gray-600 dark:text-gray-300">
                        <li>100% combed ring-spun cotton</li>
                        <li>Fabric weight: 4.3 oz/yd² (146 g/m²)</li>
                        <li>Pre-shrunk fabric</li>
                        <li>Tear-away label</li>
                        <li>Shoulder-to-shoulder taping</li>
                    </ul>
                </div>

                <div id="additional-info" class="py-6 hidden">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Additional Information</h3>
                    <table class="w-full text-gray-600 dark:text-gray-300">
                        <tr>
                            <td class="font-semibold pr-4 py-2">Material</td>
                            <td>100% Cotton</td>
                        </tr>
                        <tr>
                            <td class="font-semibold pr-4 py-2">Fit</td>
                            <td>Regular fit</td>
                        </tr>
                        <tr>
                            <td class="font-semibold pr-4 py-2">Care Instructions</td>
                            <td>Machine wash cold, tumble dry low</td>
                        </tr>
                        <tr>
                            <td class="font-semibold pr-4 py-2">Country of Origin</td>
                            <td>Made in USA</td>
                        </tr>
                    </table>
                </div>

                <div id="reviews" class="py-6 hidden">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Customer Reviews</h3>
                    <form class="mb-8">
                        <div class="mb-4">
                            <label for="rating" class="block text-gray-700 dark:text-gray-300 mb-2">Your Rating</label>
                            <div class="flex text-yellow-400">
                                @for ($i = 1; $i <= 5; $i++)
                                <button type="button" class="text-2xl focus:outline-none" onclick="setRating({{ $i }})">☆</button>
                                @endfor
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="review" class="block text-gray-700 dark:text-gray-300 mb-2">Your Review</label>
                            <textarea id="review" name="review" rows="4" class="w-full px-3 py-2 text-gray-700 border rounded-lg focus:outline-none focus:border-yellow-500" required></textarea>
                        </div>
                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-md transition-colors duration-300">
                            Submit Review
                        </button>
                    </form>

                    <!-- Sample Reviews -->
                    <div class="space-y-6">
                        @for ($i = 1; $i <= 3; $i++)
                        <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-400 mr-2">
                                    @for ($j = 1; $j <= 5; $j++)
                                    <i class="fas fa-star"></i>
                                    @endfor
                                </div>
                                <span class="text-gray-600 dark:text-gray-400">John Doe</span>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300">Great t-shirt! The fabric is soft and comfortable, and the print quality is excellent. I'll definitely be ordering more.</p>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            <div class="mt-16">
                <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Related Products</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @for ($i = 1; $i <= 4; $i++)
                    <div class="group bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-lg transition-all duration-300 hover:shadow-2xl flex flex-col h-full">
                        <div class="relative aspect-w-1 aspect-h-1 overflow-hidden">
                            <img src="https://via.placeholder.com/300x300" alt="Related Product {{ $i }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                            <div class="absolute inset-0 bg-black bg-opacity-20 group-hover:bg-opacity-50 transition-opacity duration-300"></div>
                            <div class="absolute bottom-4 left-4 right-4 flex justify-between items-end opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <button class="bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded-full shadow-lg transition-all duration-300 transform hover:scale-110 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            </div>
                        </div>
                        <div class="p-4 flex-grow flex flex-col justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-1 truncate">Related Product {{ $i }}</h3>
                                <p class="text-gray-600 dark:text-gray-300 text-sm mb-2">T-Shirts</p>
                                <p class="text-gray-700 dark:text-gray-300 text-sm mb-3 line-clamp-2">Another great custom t-shirt option with unique designs.</p>
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-xl font-bold text-yellow-500 dark:text-yellow-400">₣24.99</span>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <div class="flex text-yellow-400">
                                        @for ($j = 1; $j <= 5; $j++)
                                            <i class="fas fa-star text-xs"></i>
                                        @endfor
                                    </div>
                                    <span class="text-gray-600 dark:text-gray-400 text-xs ml-1">(18)</span>
                                </div>
                                <button class="text-gray-400 hover:text-red-500 transition-colors duration-300" title="Add to Wishlist">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>

    <x-footer />

    <script>
        // Change main image on thumbnail click and highlight the active thumbnail
        function changeMainImage(thumbnail, src) {
            const mainImage = document.getElementById('main-image');
            mainImage.src = src;

            // Remove active border from all thumbnails
            document.querySelectorAll('.thumbnail').forEach(img => {
                img.classList.remove('border-yellow-500');
                img.classList.add('border-transparent');
            });

            // Add active border to clicked thumbnail
            thumbnail.classList.remove('border-transparent');
            thumbnail.classList.add('border-yellow-500');
        }

        // Zoom effect on main image hover
        const mainImage = document.getElementById('main-image');
        const imageContainer = document.getElementById('image-zoom-container');

        imageContainer.addEventListener('mousemove', (e) => {
            const { offsetX, offsetY, target } = e;
            const { offsetWidth, offsetHeight } = target;
            
            const xPos = (offsetX / offsetWidth) * 100;
            const yPos = (offsetY / offsetHeight) * 100;

            mainImage.style.transformOrigin = `${xPos}% ${yPos}%`;
            mainImage.style.transform = "scale(2)";
        });

        imageContainer.addEventListener('mouseleave', () => {
            mainImage.style.transform = "scale(1)";
        });

        // Tab switching functionality
        function showTab(tabId) {
            document.querySelectorAll('#description, #additional-info, #reviews').forEach(tab => {
                tab.classList.add('hidden');
            });

            document.getElementById(tabId).classList.remove('hidden');

            document.querySelectorAll('nav a').forEach(link => {
                link.classList.remove('border-yellow-500', 'text-yellow-500');
                link.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
            });

            event.target.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
            event.target.classList.add('border-yellow-500', 'text-yellow-500');
        }

        // Set rating stars
        function setRating(rating) {
            const stars = document.querySelectorAll('#reviews .flex button');
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.textContent = '★';
                } else {
                    star.textContent = '☆';
                }
            });
        }
    </script>
</x-guest-layout>
