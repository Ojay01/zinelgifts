<x-guest-layout>
    <x-header />

    <!-- Shop Section -->
    <div class="bg-gray-100 dark:bg-gray-900 py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold mb-8 text-gray-800 dark:text-yellow-500">Shop</h1>

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Filters -->
                <div class="w-full lg:w-1/4">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                        <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-yellow-500">Filters</h2>
                        
                        <!-- Category Filter -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium mb-2 text-gray-700 dark:text-gray-300">Category</h3>
                            <div class="space-y-2">
                                @foreach(['T-Shirts', 'Mugs', 'Posters', 'Stickers'] as $category)
                                    <label class="flex items-center">
                                        <input type="checkbox" class="form-checkbox text-yellow-500" name="category[]" value="{{ $category }}">
                                        <span class="ml-2 text-gray-700 dark:text-gray-300">{{ $category }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Price Filter -->
                        <div>
                            <h3 class="text-lg font-medium mb-2 text-gray-700 dark:text-gray-300">Price Range</h3>
                            <div class="flex items-center">
                                <input type="number" class="w-1/2 px-2 py-1 border rounded-l" placeholder="Min" name="price_min">
                                <input type="number" class="w-1/2 px-2 py-1 border rounded-r" placeholder="Max" name="price_max">
                            </div>
                        </div>

                        <button class="mt-6 w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                            Apply Filters
                        </button>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="w-full lg:w-3/4">
                    <div id="products-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Products will be dynamically injected here by JavaScript -->
                    </div>

                    <!-- Pagination -->
                    <div class="mt-12">
                        <nav class="flex justify-center">
                            <ul id="pagination" class="flex items-center">
                                <!-- Pagination buttons will be dynamically injected here by JavaScript -->
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-footer />

    <script>
        // Generate 100 random products
        const products = Array.from({ length: 100 }, (_, i) => ({
            name: 'Product ' + (i + 1),
            category: ['T-Shirts', 'Mugs', 'Posters', 'Stickers'][Math.floor(Math.random() * 4)],
            description: 'Description for product ' + (i + 1),
            price: (Math.random() * (100 - 10) + 10).toFixed(2),
            oldPrice: (Math.random() * (150 - 110) + 110).toFixed(2),
            discount: Math.floor(Math.random() * 30) + 10,
            image: 'https://via.placeholder.com/300x300',
            reviews: Math.floor(Math.random() * 100),
        }));

        const itemsPerPage = 25;
        let currentPage = 1;

        function renderProducts() {
            const start = (currentPage - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            const productsToDisplay = products.slice(start, end);

            const productsGrid = document.getElementById('products-grid');
            productsGrid.innerHTML = '';

            productsToDisplay.forEach(product => {
                const productHtml = `
                    <div class="group bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-lg transition-all duration-300 hover:shadow-2xl flex flex-col h-full">
                        <div class="relative aspect-w-1 aspect-h-1 overflow-hidden">
                            <img src="${product.image}" alt="${product.name}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                            <div class="absolute inset-0 bg-black bg-opacity-20 group-hover:bg-opacity-50 transition-opacity duration-300"></div>
                            <div class="absolute top-4 left-4 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full shadow-md">-${product.discount}%</div>
                            <div class="absolute bottom-4 left-4 right-4 flex justify-between items-end opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <button class="bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded-full shadow-lg transition-all duration-300 transform hover:scale-110 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            </div>
                        </div>
                        <div class="p-4 flex-grow flex flex-col justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-1 truncate">${product.name}</h3>
                                <p class="text-gray-600 dark:text-gray-300 text-sm mb-2">${product.category}</p>
                                <p class="text-gray-700 dark:text-gray-300 text-sm mb-3 line-clamp-2">${product.description}</p>
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-xl font-bold text-yellow-500 dark:text-yellow-400">₣${product.price}</span>
                                    <span class="text-sm text-gray-500 line-through">₣${product.oldPrice}</span>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <div class="flex text-yellow-400">
                                        ${'<i class="fas fa-star text-xs"></i>'.repeat(5)}
                                    </div>
                                    <span class="text-gray-600 dark:text-gray-400 text-xs ml-1">(${product.reviews})</span>
                                </div>
                                <button class="text-gray-400 hover:text-red-500 transition-colors duration-300" title="Add to Wishlist">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                productsGrid.insertAdjacentHTML('beforeend', productHtml);
            });
        }

        function renderPagination() {
            const totalPages = Math.ceil(products.length / itemsPerPage);
            const pagination = document.getElementById('pagination');
            pagination.innerHTML = '';

            if (currentPage > 1) {
                pagination.innerHTML += `<li><button onclick="changePage(${currentPage - 1})" class="px-3 py-2 text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700">Previous</button></li>`;
            }

            for (let i = 1; i <= totalPages; i++) {
                pagination.innerHTML += `<li><button onclick="changePage(${i})" class="px-3 py-2 ${i === currentPage ? 'text-blue-600 bg-blue-50 border-blue-300' : 'text-gray-500 bg-white border-gray-300 hover:bg-gray-100 hover:text-gray-700'}">${i}</button></li>`;
            }

            if (currentPage < totalPages) {
                pagination.innerHTML += `<li><button onclick="changePage(${currentPage + 1})" class="px-3 py-2 text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700">Next</button></li>`;
            }
        }

        function changePage(page) {
            currentPage = page;
            renderProducts();
            renderPagination();
        }

        document.addEventListener('DOMContentLoaded', function () {
            renderProducts();
            renderPagination();
        });
    </script>
</x-guest-layout>
