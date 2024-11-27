<x-guest-layout>
    <x-header />

    <div class="bg-gray-100 dark:bg-gray-900 py-16 min-h-screen">
        <div class="container mx-auto px-4">
            <!-- Breadcrumb -->
            <nav class="text-sm mb-6" aria-label="Breadcrumb">
                <ol class="list-none p-0 inline-flex">
                    <li class="flex items-center text-gray-600 dark:text-gray-400">
                        <a href="/" class="hover:text-yellow-500 transition-colors duration-300">Home</a>
                        <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                    </li>
                    <li class="flex items-center text-gray-800 dark:text-gray-200">
                        Cart
                    </li>
                </ol>
            </nav>

            @if($cartItems->isEmpty())
                <div class="text-center py-16">
                    <div class="text-yellow-500 mb-4">
                        <i class="fas fa-shopping-cart text-6xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">Your cart is empty</h2>
                    <p class="text-gray-600 dark:text-gray-400 mb-8">Looks like you haven't added anything to your cart yet.</p>
                    <a href="{{ route('shop') }}" 
                       class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-8 rounded-md transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50 shadow-lg">
                        Continue Shopping
                    </a>
                </div>
            @else
                <!-- Cart Section -->
                <div class="flex flex-col lg:flex-row gap-12">
                    <!-- Cart Items -->
                    <div class="w-full lg:w-3/4">
                        <div class="md:flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Shopping Cart ({{ $cartItems->count() }})</h2>
                            <a href="{{ route('shop') }}" class="text-yellow-500 hover:text-yellow-600 transition-colors duration-300">
                                <i class="fas fa-arrow-left mr-2"></i>Continue Shopping
                            </a>
                        </div>

                        <!-- Cart Items -->
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                            @foreach ($cartItems as $item)
                                <div class="p-6 @if(!$loop->last) border-b border-gray-200 dark:border-gray-700 @endif" data-item-id="{{ $item->id }}">
                                    <div class="flex flex-col sm:flex-row items-start space-y-4 sm:space-y-0 sm:space-x-6">
                                        <!-- Enhanced Image Container -->
                                        <div class="relative group">
                                              <a href="{{ route('details', [$item->category, $item->subcategory, $item->name]) }}">
                                            <div class="w-32 h-32 relative overflow-hidden rounded-lg shadow-md bg-gray-50 dark:bg-gray-900">
                                                <img src="{{ $item->image_url }}" 
                                                     alt="{{ $item->name }}" 
                                                     class="absolute inset-0 w-full h-full object-contain transform transition-transform duration-300 group-hover:scale-105"
                                                     loading="lazy"
                                                     onerror="this.onerror=null; this.src='/images/placeholder.jpg';">
                                            </div>
                                              </a>
                                            @if($item->discount)
                                                <div class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full shadow-md">
                                                    -{{ $item->discount }}%
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <div class="flex-grow">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-1">{{ $item->name }}</h3>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2 font-semibold">
                                                        {{ $item->category }} / {{ $item->subcategory }}
                                                    </p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-4 line-clamp-2">
                                                        {{ Str::limit(strip_tags(htmlspecialchars_decode($item->description)), 300, '...') }}
                                                    </p>
                                                </div>
                                                <!-- Enhanced Delete Button -->
                                                <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="ml-4 delete-item-form">
                                                    @csrf
                                                    <button type="button" 
                                                            class="text-red-500 hover:text-red-600 transition-colors duration-300 delete-item-btn"
                                                            data-item-name="{{ $item->name }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>

                                            <div class="flex flex-wrap items-center justify-between gap-4">
                                                <!-- Enhanced Quantity Controls -->
                                                <div class="flex items-center space-x-3">
                                                    <div class="flex items-center border border-gray-300 dark:border-gray-600 rounded-md shadow-sm">
                                                        <button type="button" 
                                                                onclick="updateQuantity({{ $item->id }}, -1)"
                                                                class="px-3 py-1 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none transition-colors duration-200">
                                                            -
                                                        </button>
                                                        <input type="number" 
                                                               id="quantity-{{ $item->id }}" 
                                                               value="{{ $item->quantity }}"
                                                               min="1"
                                                               max="99"
                                                               class="w-16 text-center border-x border-gray-300 dark:border-gray-600 py-1 dark:bg-gray-800 focus:outline-none dark:text-gray-400 focus:ring-2 focus:ring-yellow-400 dark:focus:ring-yellow-500"
                                                               onchange="updateQuantity({{ $item->id }}, this.value)">
                                                        <button type="button"
                                                                onclick="updateQuantity({{ $item->id }}, 1)"
                                                                class="px-3 py-1 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none transition-colors duration-200">
                                                            +
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="text-right">
                                                    <div class="text-lg font-bold text-gray-800 dark:text-white">
                                                        ₣{{ number_format($item->price * $item->quantity, 2) }}
                                                    </div>
                                                    @if($item->discount)
                                                        <div class="text-sm text-gray-500 line-through">
                                                            ₣{{ number_format($item->original_price * $item->quantity, 2) }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- New Attributes Section -->
                                            <div class="mt-4 space-y-2">
                                                @if($item->attributes)
                                                <div class="flex flex-wrap dark:text-gray-300 gap-2">
                                                    @if($item->attributes->color)
                                                        <span class="bg-gray-100 dark:bg-gray-700 text-xs px-2 py-1 rounded-full">
                                                            Color: {{ $item->attributes->color->name }}
                                                        </span>
                                                    @endif
                                                    
                                                    @if($item->attributes->size)
                                                        <span class="bg-gray-100 dark:bg-gray-700 text-xs px-2 py-1 rounded-full">
                                                            Size: {{ $item->attributes->size->name }}
                                                        </span>
                                                    @endif
                                                    
                                                    @if($item->attributes->quality)
                                                        <span class="bg-gray-100 dark:bg-gray-700 text-xs px-2 py-1 rounded-full">
                                                            Quality: {{ $item->attributes->quality->name }}
                                                        </span>
                                                    @endif

                                                    @if($item->attributes->type)
                                                        <span class="bg-gray-100 dark:bg-gray-700 text-xs px-2 py-1 rounded-full">
                                                            Type: {{ $item->attributes->type->name }}
                                                        </span>
                                                    @endif
                                                </div>
                                            @endif

                                                <!-- Short Note Input -->
                                                <div class="mt-2">
                                                   <h3 class="dark:text-gray-400 font-bold text-lg py-2">Short Note</h3>
                                                    <p class="dark:text-gray-400"> <strong> {{ $item->short_note ?? 'Nothing' }}</strong> </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="w-full lg:w-1/4">
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 sticky top-6">
                            <h2 class="text-xl font-bold mb-6 text-gray-800 dark:text-white">Order Summary</h2>
                            
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <p class="text-gray-600 dark:text-gray-400">Subtotal</p>
                                    <p class="text-gray-800 dark:text-white font-bold">₣{{ number_format($subtotal, 2) }}</p>
                                </div>
                                
                                <div class="flex justify-between items-center">
                                    <p class="text-gray-600 dark:text-gray-400">Shipping</p>
                                    <p class="text-gray-800 dark:text-white font-bold">
                                        @if($shippingCost > 0)
                                            ₣{{ number_format($shippingCost, 2) }}
                                        @else
                                            Free
                                        @endif
                                    </p>
                                </div>

                                @if($shippingCost > 0)
                                    <div class="text-sm text-gray-600 dark:text-gray-400">
                                        Free shipping on orders over ₣100,000
                                    </div>
                                @endif
                                
                                <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mt-4">
                                    <div class="flex justify-between items-center">
                                        <p class="text-xl font-bold text-gray-800 dark:text-white">Total</p>
                                        <p class="text-xl font-bold text-yellow-500">₣{{ number_format($total, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('checkout') }}" 
                            class="block bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-4 rounded-md text-center mt-6 transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-50 shadow-lg">
                             Proceed to Checkout
                         </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <x-footer />


    <!-- Add SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function updateQuantity(itemId, change) {
            let input = document.getElementById('quantity-' + itemId);
            let newQuantity;
            
            if (typeof change === 'number') {
                newQuantity = parseInt(input.value) + change;
            } else {
                newQuantity = parseInt(change);
            }

            if (newQuantity < 1 || newQuantity > 99) return;

            // Show loading state
            const loadingToast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1000
            });
            loadingToast.fire({
                icon: 'info',
                title: 'Updating cart...'
            });

            fetch(`/cart/update/${itemId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    quantity: newQuantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong! Please try again.'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong! Please try again.'
                });
            });
        }

        // Enhanced delete confirmation
        document.querySelectorAll('.delete-item-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('form');
                const itemName = this.dataset.itemName;
                
                Swal.fire({
                    title: 'Remove Item',
                    text: `Are you sure you want to remove "${itemName}" from your cart?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#EF4444',
                    cancelButtonColor: '#6B7280',
                    confirmButtonText: 'Remove',
                    cancelButtonText: 'Cancel',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</x-guest-layout>