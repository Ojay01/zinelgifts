<x-guest-layout>
    <x-header />

    <div class="bg-gray-100 dark:bg-gray-900 py-8 md:py-16">
        <div class="container mx-auto px-4">
            <!-- Breadcrumb -->
            <nav class="text-sm mb-6">
                <ol class="list-none p-0 inline-flex flex-wrap">
                    <li class="flex items-center text-gray-600 dark:text-gray-400">
                        <a href="{{ url('/') }}" class="hover:text-yellow-500">Home</a>
                        <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </li>
                    <li class="flex items-center text-gray-600 dark:text-gray-400">
                        <a href="{{ route('category.show', $product->category->id) }}" class="hover:text-yellow-500">{{ $product->category->name }}</a>
                        <svg class="w-4 h-4 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </li>
                    <li class="text-yellow-500">{{ $product->subcategory->name }}</li>
                </ol>
            </nav>

            <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">
                <!-- Product Images -->
                <div class="w-full lg:w-1/2">
                    <div class="relative mb-4 rounded-xl overflow-hidden">
                        <div class="aspect-w-1 aspect-h-1">
                            <img id="main-image" 
                                src="{{ asset('storage/' . $product->image) }}" 
                                alt="{{ $product->name }}"
                                class="w-full h-full object-cover"
                            >
                        </div>
                        
                        <!-- Navigation Arrows -->
                        <button 
                            onclick="prevImage()"
                            class="absolute left-4 top-1/2 -translate-y-1/2 bg-yellow-500 p-2 rounded-full shadow-lg hover:bg-white dark:hover:bg-gray-800 transition-all"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <button 
                            onclick="nextImage()"
                            class="absolute right-4 top-1/2 -translate-y-1/2 bg-yellow-500 p-2 rounded-full shadow-lg hover:bg-white dark:hover:bg-gray-800 transition-all"
                        >
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Thumbnails Slider -->
                    <div class="relative">
                        <div class="flex gap-2 overflow-x-auto pb-2 snap-x scrollbar-hide" id="thumbnails">
                            <img 
                                src="{{ asset('storage/' . $product->image) }}" 
                                alt="{{ $product->name }}"
                                class="thumbnail flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden snap-start cursor-pointer border-2 border-transparent hover:border-yellow-500 transition-all"
                                onclick="changeMainImage(this, this.src)"
                            >
                            @if($product->productImages->count() > 0)
                                @foreach($product->productImages as $productImage)
                                    <img 
                                        src="{{ asset('storage/' . $productImage->image) }}" 
                                        alt="Additional Product Image"
                                        class="thumbnail flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden snap-start cursor-pointer border-2 border-transparent hover:border-yellow-500 transition-all"
                                        onclick="changeMainImage(this, this.src)"
                                    >
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Product Details -->
                <div class="w-full lg:w-1/2">
                    <h1 class="text-3xl font-bold mb-4 text-gray-800 dark:text-white">{{ $product->name }}</h1>
                    <script type="application/json" id="product-data">
                        @php
                        $priceData = [
                            'basePrice' => $product->price,
                            'baseDiscount' => $product->discount,
                            'variableType' => $product->attributes->variable_type ?? 0,
                            'priceAttributes' => json_decode($product->attributes->prices ?? '[]')
                        ];
                        echo json_encode($priceData);
                        @endphp
                    </script>
                    <!-- Reviews -->
                    <div class="flex items-center mb-4">
                        <div class="flex text-gray-400 mr-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                </svg>
                            @endfor
                        </div>
                        <span class="text-gray-600 dark:text-gray-400">({{ $product->reviews_count ?? 0 }} reviews)</span>
                    </div>

                    <!-- Price -->
                    <div class="mb-8">
                        <span class="text-3xl font-bold text-yellow-500 product-price">₣{{ number_format($product->discounted_price, 2) }}</span>
                        @if ($product->discount > 0 || ($product->attributes && !empty(json_decode($product->attributes->prices ?? '[]'))))
                            <span class="ml-2 text-gray-500 line-through product-original-price"
                                  @if ($product->discount == 0) style="display: none;" @endif>
                                ₣{{ number_format($product->price, 2) }}
                            </span>
                        @endif
                    </div>
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <!-- Attributes -->
                    @if($colors->isNotEmpty())
                    <div class="mb-6">
                        <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Color</h3>
                        <div class="flex flex-wrap gap-3 max-h-32 md:max-h-none overflow-y-auto pb-2">
                            @foreach($colors as $color)
                                <div class="relative group">
                                    <input 
                                        type="radio" 
                                        name="attributes[color_id]" 
                                        id="color-{{ $color->id }}" 
                                        value="{{ $color->id }}"
                                        class="sr-only color-radio"
                                        @if($loop->first) checked @endif
                                    >
                                    <label 
                                        for="color-{{ $color->id }}"
                                        class="block w-10 h-10 rounded-full cursor-pointer border-2 border-transparent transition-all relative color-label"
                                        style="background-color: {{ $color->value }};"
                                    >
                                        <span class="sr-only dark:text-white">{{ $color->name }}</span>
                                    </label>
                                    <span class="absolute -bottom-6 left-1/2 -translate-x-1/2 whitespace-nowrap dark:text-white text-sm opacity-0 group-hover:opacity-100 transition-opacity">
                                        {{ ucfirst($color->name) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
        
                    <!-- Sizes Section -->
                    @if($sizes->isNotEmpty())
                    <div class="mb-6">
                        <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Size</h3>
                        <div class="flex flex-wrap gap-3 max-h-32 md:max-h-none overflow-y-auto pb-2">
                            @foreach($sizes as $size)
                                <div class="relative">
                                    <input 
                                        type="radio" 
                                        name="attributes[size_id]" 
                                        id="size-{{ $size->id }}" 
                                        value="{{ $size->id }}"
                                        class="sr-only size-radio"
                                        @if($loop->first) checked @endif
                                    >
                                    <label 
                                        for="size-{{ $size->id }}"
                                        class="min-w-[2.5rem] h-10 dark:text-white px-3 rounded-lg cursor-pointer border-2 border-gray-200 flex items-center justify-center text-sm font-medium transition-all size-label"
                                    >
                                        {{ ucfirst($size->name) }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
        
                    <!-- Types Section -->
                    @if($types->isNotEmpty())
                    <div class="mb-6">
                        <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Type</h3>
                        <div class="flex flex-wrap gap-3 max-h-32 md:max-h-none overflow-y-auto pb-2">
                            @foreach($types as $type)
                                <div class="relative">
                                    <input 
                                        type="radio" 
                                        name="attributes[type_id]" 
                                        id="type-{{ $type->id }}" 
                                        value="{{ $type->id }}"
                                        class="sr-only type-radio"
                                        @if($loop->first) checked @endif
                                    >
                                    <label 
                                        for="type-{{ $type->id }}"
                                        class="min-w-[2.5rem] dark:text-white h-10 px-3 rounded-lg cursor-pointer border-2 border-gray-200 flex items-center justify-center text-sm font-medium transition-all type-label"
                                    >
                                        {{ ucfirst($type->name) }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Qualities Section -->
                    @if($qualities->isNotEmpty())
                    <div class="mb-6">
                        <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Quality</h3>
                        <div class="flex flex-wrap gap-3 max-h-32 md:max-h-none overflow-y-auto pb-2">
                            @foreach($qualities as $quality)
                                <div class="relative">
                                    <input 
                                        type="radio" 
                                        name="attributes[quality_id]" 
                                        id="quality-{{ $quality->id }}" 
                                        value="{{ $quality->id }}"
                                        class="sr-only quality-radio"
                                        @if($loop->first) checked @endif
                                    >
                                    <label 
                                        for="quality-{{ $quality->id }}"
                                        class="min-w-[2.5rem] dark:text-white h-10 px-3 rounded-lg cursor-pointer border-2 border-gray-200 flex items-center justify-center text-sm font-medium transition-all quality-label"
                                    >
                                        {{ ucfirst($quality->name) }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Note Section - With working character counter -->
                    <div class="mb-6" x-data="{ charCount: 0, photoPreview: null }">
                        <label for="note" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Special Instructions
                            <span class="text-gray-500 text-xs ml-1">(Optional)</span>
                        </label>
                        <div class="relative">
                            <textarea
                                name="short_note"
                                id="note"
                                rows="3"
                                maxlength="500"
                                placeholder="Add any special instructions or notes for this order..."
                                x-on:input="charCount = $el.value.length"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:placeholder-gray-500 resize-none"
                            ></textarea>
                            <div class="absolute bottom-2 right-2 text-xs text-gray-500 dark:text-gray-400">
                                <span x-text="charCount">0</span>/500
                            </div>
                        </div>
                        @error('short_note')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Upload a Photo (Optional)
                            </label>
                            <input
                                type="file"
                                name="photo"
                                accept="image/*"
                                x-on:change="photoPreview = URL.createObjectURL($event.target.files[0])"
                                class="block w-full text-sm text-gray-500 dark:text-gray-400 border border-gray-300 rounded-lg cursor-pointer focus:outline-none dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-500"
                            />
                            <div
                                x-show="photoPreview"
                                class="mt-4 border border-gray-300 rounded-lg overflow-hidden w-40 h-40"
                            >
                                <img
                                    :src="photoPreview"
                                    alt="Preview"
                                    class="w-full h-full object-cover"
                                />
                            </div>
                        </div>
                    </div>

                    <!-- Add to Cart -->
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-24">
                            <input 
                                type="number"
                                name="quantity"
                                min="1"
                                value="1"
                                class="w-full px-3 py-2 border dark:text-white border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 dark:bg-gray-800 dark:border-gray-700"
                            >
                        </div>
                        <button type="submit" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-6 rounded-lg transition-colors">
                            Add to Cart
                        </button>
                    </div>

                    <!-- Description -->
                    <div class="prose dark:prose-invert max-w-none">
                        {!! $product->description !!}
                    </div>
                    </form>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="mt-16">
                <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">Reviews</h2>
                <!-- Add your reviews content here -->
            </div>
        </div>
    </div>

    <x-footer />

    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Image Gallery functionality
    const mainImage = document.getElementById('main-image');
    const thumbnails = document.querySelectorAll('.thumbnail');
    let currentImageIndex = 0;
    const totalImages = thumbnails.length;

    function changeMainImage(element, newSrc) {
        mainImage.src = newSrc;
        thumbnails.forEach(thumb => {
            thumb.classList.remove('border-yellow-500');
            thumb.classList.add('border-transparent');
        });
        element.classList.remove('border-transparent');
        element.classList.add('border-yellow-500');
        
        // Update current index
        currentImageIndex = Array.from(thumbnails).indexOf(element);
    }

    function nextImage() {
        currentImageIndex = (currentImageIndex + 1) % totalImages;
        const nextThumb = thumbnails[currentImageIndex];
        changeMainImage(nextThumb, nextThumb.src);
        scrollThumbnailIntoView(nextThumb);
    }

    function prevImage() {
        currentImageIndex = (currentImageIndex - 1 + totalImages) % totalImages;
        const prevThumb = thumbnails[currentImageIndex];
        changeMainImage(prevThumb, prevThumb.src);
        scrollThumbnailIntoView(prevThumb);
    }

    function scrollThumbnailIntoView(thumbnail) {
        const thumbnailsContainer = document.getElementById('thumbnails');
        thumbnailsContainer.scrollTo({
            left: thumbnail.offsetLeft - thumbnailsContainer.offsetWidth / 2 + thumbnail.offsetWidth / 2,
            behavior: 'smooth'
        });
    }

    // Initialize the first image as selected
    if (thumbnails.length > 0) {
        thumbnails[0].classList.remove('border-transparent');
        thumbnails[0].classList.add('border-yellow-500');
    }

    // Make functions available globally
    window.changeMainImage = changeMainImage;
    window.nextImage = nextImage;
    window.prevImage = prevImage;
    
    // Color selection functionality
    const colorRadios = document.querySelectorAll('.color-radio');
    const colorLabels = document.querySelectorAll('.color-label');
    
    colorRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            // Remove selected class from all color labels
            colorLabels.forEach(label => {
                label.style.borderColor = 'transparent';
            });
            
            // Add selected class to clicked color label
            if (this.checked) {
                const label = document.querySelector(`label[for="${this.id}"]`);
                label.style.borderColor = '#c19d56';
            }
        });
    });
    
    // Size selection functionality
    const sizeRadios = document.querySelectorAll('.size-radio');
    const sizeLabels = document.querySelectorAll('.size-label');
    
    sizeRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            // Remove selected class from all size labels
            sizeLabels.forEach(label => {
                label.style.borderColor = '#e5e7eb';
            });
            
            // Add selected class to clicked size label
            if (this.checked) {
                const label = document.querySelector(`label[for="${this.id}"]`);
                label.style.borderColor = '#c19d56';
            }
        });
    });
    
    // Type selection functionality
    const typeRadios = document.querySelectorAll('.type-radio');
    const typeLabels = document.querySelectorAll('.type-label');
    
    typeRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            // Remove selected class from all type labels
            typeLabels.forEach(label => {
                label.style.borderColor = '#e5e7eb';
            });
            
            // Add selected class to clicked type label
            if (this.checked) {
                const label = document.querySelector(`label[for="${this.id}"]`);
                label.style.borderColor = '#c19d56';
            }
        });
    });
    
    // Quality selection functionality
    const qualityRadios = document.querySelectorAll('.quality-radio');
    const qualityLabels = document.querySelectorAll('.quality-label');
    
    qualityRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            // Remove selected class from all quality labels
            qualityLabels.forEach(label => {
                label.style.borderColor = '#e5e7eb';
            });
            
            // Add selected class to clicked quality label
            if (this.checked) {
                const label = document.querySelector(`label[for="${this.id}"]`);
                label.style.borderColor = '#c19d56';
            }
        });
    });
    
    // Initialize all selections
    const initRadio = function(radioClass, labelClass, selectedColor) {
        const firstChecked = document.querySelector(`${radioClass}:checked`);
        if (firstChecked) {
            const label = document.querySelector(`label[for="${firstChecked.id}"]`);
            if (label) {
                label.style.borderColor = selectedColor;
            }
        }
    };
    
    initRadio('.color-radio', '.color-label', '#c19d56');
    initRadio('.size-radio', '.size-label', '#c19d56');
    initRadio('.type-radio', '.type-label', '#c19d56');
    initRadio('.quality-radio', '.quality-label', '#c19d56');
});
    </script>

<script src="/js/product-variant.js"></script>
</x-guest-layout>