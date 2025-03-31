<x-admin-layout>
    <div id="toaster" class="fixed top-4 right-4 z-50 space-y-2"></div>
    <div class="mt-4 sm:mt-6 container mx-auto px-4">
        <div class="bg-slate-800 rounded-lg border border-slate-700 shadow-lg">
            <div class="p-4 sm:p-6 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-300">
                    Create Product
                </h3>
                <a href="{{ route('products.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white rounded-lg transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Products
                </a>
            </div>

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="p-4 sm:p-6 border-t border-slate-700">
                @csrf

                <div class="space-y-6">
                    <!-- Image Preview Container -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Product Image</label>
                        <div class="relative h-32 w-32">
                            <img id="imagePreview" 
                                 src="/api/placeholder/128/128"
                                 alt="Product preview" 
                                 class="h-32 w-32 object-cover rounded-lg border border-slate-700">
                        </div>
                    </div>

                    <!-- Image Upload -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-300 mb-2">Upload Image</label>
                        <input type="file" 
                               id="image" 
                               name="image" 
                               accept="image/*"
                               required
                               class="block w-full text-sm text-gray-300
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-lg file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-slate-700 file:text-gray-300
                                      hover:file:bg-slate-600
                                      file:cursor-pointer cursor-pointer">
                        @error('image')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Product Name</label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}"
                               required
                               class="w-full rounded-lg border border-slate-700 bg-slate-900 px-4 py-2 text-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        @error('name')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Variable Pricing Toggle -->
                    <div>
                        <div class="flex items-center space-x-3">
                            <input type="checkbox" 
                                   id="variable" 
                                   name="variable" 
                                   value="1"
                                   {{ old('variable') ? 'checked' : '' }}
                                   class="h-4 w-4 rounded border-slate-700 text-blue-600 focus:ring-blue-500">
                            <label for="variable" class="text-sm font-medium text-gray-300">Variable Pricing</label>
                        </div>
                        <p class="mt-1 text-sm text-gray-400">Enable if price varies by size or quality</p>
                    </div>

                    <!-- Price (displayed when variable is false) -->
                    <div id="standard-price-container">
                        <label for="price" class="block text-sm font-medium text-gray-300 mb-2">Price (₣)</label>
                        <input type="number" 
                               id="price" 
                               name="price" 
                               value="{{ old('price', 0) }}"
                               step="0.01"
                               required
                               class="w-full rounded-lg border border-slate-700 bg-slate-900 px-4 py-2 text-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        @error('price')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Variable Price Container (hidden by default) -->
                    <div id="variable-price-container" class="hidden space-y-4 p-4 bg-slate-800 border border-slate-700 rounded-lg">
                        <h4 class="text-md font-medium text-gray-300">Variable Pricing</h4>
                        
                        <!-- Variation Type Selection -->
                        <div class="flex flex-col space-y-2">
                            <label class="text-sm font-medium text-gray-300">Variation Based On:</label>
                            <div class="flex space-x-4">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="radio" name="variation_type" value="size" class="form-radio" checked>
                                    <span class="ml-2 text-gray-300">Size</span>
                                </label>
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="radio" name="variation_type" value="quality" class="form-radio">
                                    <span class="ml-2 text-gray-300">Quality</span>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Size Variants Container -->
                        <div id="size-variants-container" class="space-y-3">
                            <p class="text-sm text-gray-400">Set different prices for each size</p>
                            <div id="size-variants" class="space-y-2">
                                <!-- Size variant rows will be added here dynamically -->
                            </div>
                        </div>
                        
                        <!-- Quality Variants Container -->
                        <div id="quality-variants-container" class="space-y-3 hidden">
                            <p class="text-sm text-gray-400">Set different prices for each quality level</p>
                            <div id="quality-variants" class="space-y-2">
                                <!-- Quality variant rows will be added here dynamically -->
                            </div>
                        </div>
                    </div>

                    <!-- Discount -->
                    <div>
                        <label for="discount" class="block text-sm font-medium text-gray-300 mb-2">Discount Percentage</label>
                        <input type="number" 
                               id="discount" 
                               name="discount" 
                               value="{{ old('discount', 0) }}"
                               min="0"
                               max="100"
                               class="w-full rounded-lg border border-slate-700 bg-slate-900 px-4 py-2 text-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        @error('discount')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-300 mb-2">Category</label>
                        <select id="category_id" 
                                name="category_id"
                                required
                                class="w-full rounded-lg border border-slate-700 bg-slate-900 px-4 py-2 text-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Subcategory -->
                    <div>
                        <label for="subcategory_id" class="block text-sm font-medium text-gray-300 mb-2">Subcategory</label>
                        <select id="subcategory_id" 
                                name="subcategory_id"
                                class="w-full rounded-lg border border-slate-700 bg-slate-900 px-4 py-2 text-gray-300 focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Select Subcategory</option>
                        </select>
                        @error('subcategory_id')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                        <textarea id="description" 
                                  name="description" 
                                  class="hidden">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Attributes Section -->
                    <div class="space-y-6 border-t border-slate-700 pt-6">
                        <h4 class="text-lg font-medium text-gray-300">Product Attributes</h4>
                        
                        <!-- Sizes -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Sizes</label>
                            <select id="sizes" 
                                    name="attributes[sizes][]" 
                                    multiple
                                    class="select2-multiple w-full">
                                @foreach($sizes as $size)
                                    <option value="{{ $size->id }}"
                                            {{ in_array($size->id, old('attributes.sizes', [])) ? 'selected' : '' }}>
                                        {{ $size->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('attributes.sizes')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    
                        <!-- Colors -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Colors</label>
                            <select id="colors" 
                                    name="attributes[colors][]" 
                                    multiple
                                    class="select2-multiple w-full">
                                @foreach($colors as $color)
                                    <option value="{{ $color->id }}"
                                            {{ in_array($color->id, old('attributes.colors', [])) ? 'selected' : '' }}>
                                        {{ $color->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('attributes.colors')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    
                        <!-- Quality -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Quality</label>
                            <select id="qualities" 
                                    name="attributes[qualities][]" 
                                    multiple
                                    class="select2-multiple w-full">
                                @foreach($qualities as $quality)
                                    <option value="{{ $quality->id }}"
                                            {{ in_array($quality->id, old('attributes.qualities', [])) ? 'selected' : '' }}>
                                        {{ $quality->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('attributes.qualities')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    
                        <!-- Types -->
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Types</label>
                            <select id="types" 
                                    name="attributes[types][]" 
                                    multiple
                                    class="select2-multiple w-full">
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}"
                                            {{ in_array($type->id, old('attributes.types', [])) ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('attributes.types')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Create Product
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- Select2 Styles -->
    <style>
        .select2-container--default .select2-selection--multiple {
            background-color: rgb(15 23 42) !important; 
            border: 1px solid rgb(51 65 85) !important;
            min-height: 42px !important;
            padding: 2px 8px !important;
        }
        
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: rgb(59 130 246) !important;
            outline: 0;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: rgb(51 65 85) !important;
            border: none !important;
            border-radius: 0.375rem !important;
            padding: 8px 12px !important;
            margin: 4px !important;
            align-items: center !important;
            gap: 4px !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            border: none !important;
            background: none !important;
            padding: 8px !important;
            order: 2 !important;
            font-size: 14px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 16px !important;
            height: 16px !important;
            border-radius: 50% !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
            color: rgb(239 68 68) !important;
        }

        .select2-dropdown {
            background-color: rgb(15 23 42) !important;
            border: 1px solid rgb(51 65 85) !important;
            border-radius: 0.5rem !important;
            margin-top: 4px !important;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            background-color: rgb(30 41 59) !important;
            border: 1px solid rgb(71 85 105) !important;
            border-radius: 0.375rem !important;
            padding: 8px 12px !important;
            margin: 8px !important;
            width: calc(100% - 16px) !important;
        }

        .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: transparent !important;
            position: relative !important;
            padding-left: 32px !important;
        }

        .select2-container--default .select2-results__option[aria-selected=true]::before {
            content: '✓' !important;
            position: absolute !important;
            left: 12px !important;
            color: rgb(34 197 94) !important;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: rgb(30 41 59) !important;
        }
    </style>

    <!-- Initialize Components -->
    <script>
        // Image Preview
        document.getElementById('image').addEventListener('change', function(event) {
            const imagePreview = document.getElementById('imagePreview');
            const file = event.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        // TinyMCE Editor
        tinymce.init({
            selector: '#description',
            plugins: 'lists link image table code help wordcount',
            toolbar: 'undo redo | blocks | ' +
                    'bold italic | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
            skin: 'oxide-dark',
            content_css: 'dark',
            height: 400,
            menubar: true,
            branding: false,
            promotion: false,
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                });
            },
            content_style: `
                body {
                    background-color: #1e293b;
                    color: #d1d5db;
                }
                .mce-content-body[data-mce-placeholder]:not(.mce-visualblocks)::before {
                    color: #9ca3af;
                }
            `,
        });

        // Select2 Initialization
        $(document).ready(function() {
            $('.select2-multiple').select2({
                theme: 'default',
                placeholder: 'Search and select items...',
                allowClear: true,
                width: '100%',
                closeOnSelect: false,
                selectionCssClass: 'select2--selection',
                dropdownCssClass: 'select2--dropdown',
                language: {
                    searching: function() {
                        return "Searching...";
                    },
                    noResults: function() {
                        return "No matches found";
                    }
                }
            }).on('select2:opening select2:closing', function(event) {
                $(this).parents('.select2-container').find('.select2-search__field').blur();
            });
        });

        // Dynamic Subcategories
        document.addEventListener('DOMContentLoaded', function() {
            const categorySelect = document.getElementById('category_id');
            const subcategorySelect = document.getElementById('subcategory_id');

            function fetchSubcategories(categoryId) {
                subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';
                
                if (!categoryId) return;

                subcategorySelect.disabled = true;
                
                fetch(`/api/categories/${categoryId}/subcategories`)
                    .then(response => response.json())
                    .then(subcategories => {
                        subcategories.forEach(subcategory => {
                            const option = new Option(
                                subcategory.name, 
                                subcategory.id,
                                false,
                                subcategory.id == '{{ old("subcategory_id") }}'
                            );
                            subcategorySelect.add(option);
                        });
                    })
                    .catch(error => console.error('Error:', error))
                    .finally(() => {
                        subcategorySelect.disabled = false;
                    });
            }

            // Initial load if category is selected
            if (categorySelect.value) {
                fetchSubcategories(categorySelect.value);
            }

            // Update subcategories when category changes
            categorySelect.addEventListener('change', (e) => {
                fetchSubcategories(e.target.value);
            });
        });

        // Handle Variable Pricing
        document.addEventListener('DOMContentLoaded', function() {
            const variableCheckbox = document.getElementById('variable');
            const standardPriceContainer = document.getElementById('standard-price-container');
            const variablePriceContainer = document.getElementById('variable-price-container');
            const sizeVariantsContainer = document.getElementById('size-variants-container');
            const qualityVariantsContainer = document.getElementById('quality-variants-container');
            const sizeVariants = document.getElementById('size-variants');
            const qualityVariants = document.getElementById('quality-variants');
            const variationTypeRadios = document.querySelectorAll('input[name="variation_type"]');
            const sizes = document.getElementById('sizes');
            const qualities = document.getElementById('qualities');

            // Function to toggle between standard and variable pricing
            function togglePricingType() {
                if (variableCheckbox.checked) {
                    standardPriceContainer.classList.add('hidden');
                    variablePriceContainer.classList.remove('hidden');
                    document.getElementById('price').removeAttribute('required');
                    updateVariantFields();
                } else {
                    standardPriceContainer.classList.remove('hidden');
                    variablePriceContainer.classList.add('hidden');
                    document.getElementById('price').setAttribute('required', 'required');
                }
            }

            // Function to toggle between size and quality variants
            function toggleVariantType() {
                const variationType = document.querySelector('input[name="variation_type"]:checked').value;
                
                if (variationType === 'size') {
                    sizeVariantsContainer.classList.remove('hidden');
                    qualityVariantsContainer.classList.add('hidden');
                    updateSizeVariants();
                } else {
                    sizeVariantsContainer.classList.add('hidden');
                    qualityVariantsContainer.classList.remove('hidden');
                    updateQualityVariants();
                }
            }

            // Function to update size variant fields
            function updateSizeVariants() {
                const selectedSizes = Array.from(sizes.selectedOptions).map(option => ({
                    id: option.value,
                    name: option.text
                }));
                
                sizeVariants.innerHTML = '';
                
                if (selectedSizes.length === 0) {
                    sizeVariants.innerHTML = '<p class="text-yellow-400 text-sm">Please select at least one size attribute</p>';
                    return;
                }
                
                selectedSizes.forEach(size => {
                    const row = document.createElement('div');
                    row.className = 'flex items-center space-x-3';
                    row.innerHTML = `
                        <div class="w-1/3 flex items-center">
                            <span class="text-gray-300">${size.name}</span>
                            <input type="hidden" name="variants[size][${size.id}][id]" value="${size.id}">
                        </div>
                        <div class="w-2/3">
                            <input type="number" 
                                   name="variants[size][${size.id}][price]" 
                                   value="0" 
                                   step="0.01" 
                                   min="0"
                                   class="w-full rounded-lg border border-slate-700 bg-slate-900 px-4 py-2 text-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                   required>
                        </div>
                    `;
                    sizeVariants.appendChild(row);
                });
            }

            // Function to update quality variant fields
            function updateQualityVariants() {
                const selectedQualities = Array.from(qualities.selectedOptions).map(option => ({
                    id: option.value,
                    name: option.text
                }));
                
                qualityVariants.innerHTML = '';
                
                if (selectedQualities.length === 0) {
                    qualityVariants.innerHTML = '<p class="text-yellow-400 text-sm">Please select at least one quality attribute</p>';
                    return;
                }
                
                selectedQualities.forEach(quality => {
                    const row = document.createElement('div');
                    row.className = 'flex items-center space-x-3';
                    row.innerHTML = `
                        <div class="w-1/3 flex items-center">
                            <span class="text-gray-300">${quality.name}</span>
                            <input type="hidden" name="variants[quality][${quality.id}][id]" value="${quality.id}">
                        </div>
                        <div class="w-2/3">
                            <input type="number" 
                                   name="variants[quality][${quality.id}][price]" 
                                   value="0" 
                                   step="0.01" 
                                   min="0"
                                   class="w-full rounded-lg border border-slate-700 bg-slate-900 px-4 py-2 text-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                   required>
                        </div>
                    `;
                    qualityVariants.appendChild(row);
                });
            }

            // Function to update variant fields based on current selections
            function updateVariantFields() {
                const variationType = document.querySelector('input[name="variation_type"]:checked').value;
                
                if (variationType === 'size') {
                    updateSizeVariants();
                } else {
                    updateQualityVariants();
                }
            }

            // Initial state
            togglePricingType();
            
            // Event listeners
            variableCheckbox.addEventListener('change', togglePricingType);
            
            variationTypeRadios.forEach(radio => {
                radio.addEventListener('change', toggleVariantType);
            });
            
            sizes.addEventListener('change', function() {
                if (variableCheckbox.checked && document.querySelector('input[name="variation_type"]:checked').value === 'size') {
                    updateSizeVariants();
                }
            });
            
            qualities.addEventListener('change', function() {
                if (variableCheckbox.checked && document.querySelector('input[name="variation_type"]:checked').value === 'quality') {
                    updateQualityVariants();
                }
            });
        });
    </script>
</x-admin-layout>