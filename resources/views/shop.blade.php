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

                        <!-- Category Filter with Collapsible Subcategories -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium mb-2 text-gray-700 dark:text-gray-300">Category</h3>
                            <div class="space-y-2">
                                @foreach($categories as $category)
                                <div x-data="{
                                    open: {{ in_array($category->id, request('category', [])) ? 'true' : 'false' }},
                                    toggleSubcategories(isChecked) {
                                        if (!isChecked) {
                                            // Uncheck all subcategory checkboxes
                                            document.querySelectorAll('input[name=\'subcategory[]\'][data-category=\'{{ $category->id }}\']').forEach(checkbox => {
                                                checkbox.checked = false;
                                            });
                                        }
                                    }
                                }">
                                    <label class="flex items-center">
                                        <input type="checkbox" class="form-checkbox text-yellow-500" name="category[]" value="{{ $category->id }}"
                                            @click="open = !open; toggleSubcategories($event.target.checked)"
                                            {{ request('category') && in_array($category->id, request('category')) ? 'checked' : '' }}>
                                        <span class="ml-2 text-gray-700 dark:text-gray-300">{{ $category->name }}</span>
                                    </label>
                                
                                    <!-- Subcategories Collapse -->
                                    <div x-show="open" x-transition class="ml-4 space-y-2">
                                        @foreach($category->subcategories as $subcategory)
                                            <label class="flex items-center">
                                                <input type="checkbox" class="form-checkbox text-yellow-500" name="subcategory[]" value="{{ $subcategory->id }}" data-category="{{ $category->id }}"
                                                    {{ request('subcategory') && in_array($subcategory->id, request('subcategory')) ? 'checked' : '' }}>
                                                <span class="ml-2 text-gray-700 dark:text-gray-300">{{ $subcategory->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                                
                                @endforeach
                            </div>
                        </div>

                        <!-- Price Filter -->
                        <div>
                            <h3 class="text-lg font-medium mb-2 text-gray-700 dark:text-gray-300">Price Range</h3>
                            <div class="flex items-center">
                                <input type="number" class="w-1/2 px-2 py-1 border rounded-l" placeholder="Min" name="price_min" value="{{ request('price_min') }}">
                                <input type="number" class="w-1/2 px-2 py-1 border rounded-r" placeholder="Max" name="price_max" value="{{ request('price_max') }}">
                            </div>
                        </div>

                        <button class="mt-6 w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded" onclick="applyFilters()">
                            Apply Filters
                        </button>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="w-full lg:w-3/4">
                    <div id="products-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($products as $product)
                            <div class="group bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-lg transition-all duration-300 hover:shadow-2xl flex flex-col h-full">
                                <div class="relative aspect-w-1 aspect-h-1 overflow-hidden">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-80 object-cover transition-transform duration-300 group-hover:scale-110">
                                    <div class="absolute inset-0 bg-black bg-opacity-20 group-hover:bg-opacity-50 transition-opacity duration-300"></div>
                                    @if($product->discount)
                                        <div class="absolute top-4 left-4 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full shadow-md">
                                            -{{ $product->discount }}%
                                        </div>
                                    @endif
                                    <div class="absolute bottom-4 left-4 right-4 flex justify-between items-end opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                            @csrf
                                        <button class="bg-yellow-500 hover:bg-yellow-600 text-white p-2 rounded-full shadow-lg transition-all duration-300 transform hover:scale-110 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                    </form>
                                    </div>
                                </div>
                                <div class="p-4 flex-grow flex flex-col justify-between">
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-1 truncate">{{ $product->name }}</h3>
                                        <p class="text-gray-600 dark:text-gray-300 text-sm mb-2">{{ $product->category->name }}</p>
                                        <p class="text-gray-700 dark:text-gray-300 text-sm mb-3 line-clamp-2">{{ $product->description }}</p>
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="text-xl font-bold text-yellow-500 dark:text-yellow-400">₣{{ number_format($product->discounted_price, 2) }}</span>
                                            @if($product->discount)
                                                <span class="text-sm text-gray-500 line-through">₣{{ number_format($product->price, 2) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <div class="flex items-center">
                                            <div class="flex text-yellow-400">
                                                {!! str_repeat('<i class="fas fa-star text-xs"></i>', 5) !!}
                                            </div>
                                            <span class="text-gray-600 dark:text-gray-400 text-xs ml-1">({{ $product->reviews_count ?? 0 }})</span>
                                        </div>
                                        <form 
                                            action="{{ in_array($product->id, $wishlist) ? route('wishlist.removeProduct', $product->id) : route('wishlist.add', $product->id) }}" 
                                            method="POST" 
                                            class="inline">
                                            @csrf
                                            <button class="text-red-500 hover:text-gray-500 transition-colors duration-300" title="{{ in_array($product->id, $wishlist) ? 'Remove from Wishlist' : 'Add to Wishlist' }}">
                                                <i class="{{ in_array($product->id, $wishlist) ? 'fas' : 'far' }} fa-heart"></i>
                                            </button>
                                        </form>
                                    </div>
                                    

                        <a href="{{ route('details', [$product->category->name, $product->subcategory->name, $product->name]) }}" class="text-yellow-500 text-end hover:underline mt-2 block">View Product</a> 
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 dark:text-gray-400">No products found matching the filters.</p>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-12">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-footer />

    <script>
        function applyFilters() {
            const form = document.createElement('form');
            form.method = 'GET';
            form.action = "{{ route('shop') }}";

            // Collect category and subcategory filters
            const categoryCheckboxes = document.querySelectorAll('input[name="category[]"]:checked');
            const subcategoryCheckboxes = document.querySelectorAll('input[name="subcategory[]"]:checked');
            categoryCheckboxes.forEach(checkbox => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'category[]';
                input.value = checkbox.value;
                form.appendChild(input);
            });
            subcategoryCheckboxes.forEach(checkbox => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'subcategory[]';
                input.value = checkbox.value;
                form.appendChild(input);
            });

            // Collect price filters
            const priceMin = document.querySelector('input[name="price_min"]').value;
            const priceMax = document.querySelector('input[name="price_max"]').value;
            if (priceMin) {
                const minInput = document.createElement('input');
                minInput.type = 'hidden';
                minInput.name = 'price_min';
                minInput.value = priceMin;
                form.appendChild(minInput);
            }
            if (priceMax) {
                const maxInput = document.createElement('input');
                maxInput.type = 'hidden';
                maxInput.name = 'price_max';
                maxInput.value = priceMax;
                form.appendChild(maxInput);
            }

            document.body.appendChild(form);
            form.submit();
        }
    </script>
</x-guest-layout>
