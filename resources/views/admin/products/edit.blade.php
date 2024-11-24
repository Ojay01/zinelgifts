<x-admin-layout>
    <div id="toaster" class="fixed top-4 right-4 z-50 space-y-2"></div>
    <div class="mt-4 sm:mt-6 container mx-auto px-4">
        <div class="bg-slate-800 rounded-lg border border-slate-700 shadow-lg">
            <div class="p-4 sm:p-6 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-300">
                    Edit Product
                </h3>
                <a href="{{ route('products.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white rounded-lg transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Products
                </a>
            </div>

            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="p-4 sm:p-6 border-t border-slate-700">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <!-- Image Preview Container -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Product Image</label>
                        <div class="relative h-32 w-32">
                            <img id="imagePreview" 
                                 src="{{ asset('storage/' . $product->image) }}" 
                                 alt="{{ $product->name }}" 
                                 class="h-32 w-32 object-cover rounded-lg border border-slate-700">
                        </div>
                    </div>

                    <!-- Image Upload -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-300 mb-2">Update Image</label>
                        <input type="file" 
                               id="image" 
                               name="image" 
                               accept="image/*"
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
           <!-- Product Images -->
            <!-- Product Images Section -->
           
                    
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Product Name</label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $product->name) }}"
                               class="w-full rounded-lg border border-slate-700 bg-slate-900 px-4 py-2 text-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        @error('name')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-300 mb-2">Price (₣)</label>
                        <input type="number" 
                               id="price" 
                               name="price" 
                               value="{{ old('price', $product->price ?? 0) }}"
                               step="0.01"
                               class="w-full rounded-lg border border-slate-700 bg-slate-900 px-4 py-2 text-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        @error('price')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Discount -->
                    <div>
                        <label for="discount" class="block text-sm font-medium text-gray-300 mb-2">Discount Percentage</label>
                        <input type="number" 
                               id="discount" 
                               name="discount" 
                               value="{{ old('discount', $product->discount ?? 0) }}"
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
            class="w-full rounded-lg border border-slate-700 bg-slate-900 px-4 py-2 text-gray-300 focus:border-blue-500 focus:ring-blue-500">
        <option value="">Select Category</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" 
                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
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
        @if($product->subcategory_id)
            <option value="{{ $product->subcategory_id }}" selected>
                {{ $product->subcategory->name }}
            </option>
        @endif
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
                                  class="hidden">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Add this inside the space-y-6 div, before the submit button -->

<!-- Attributes Section -->
<div class="space-y-6 border-t border-slate-700 pt-6">
    <h4 class="text-lg font-medium text-gray-300">Product Attributes</h4>
    
    <!-- Sizes -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    /* Container Styles */
    .select2-container--default .select2-selection--multiple {
        background-color: rgb(15 23 42) !important; 
        border: 1px solid rgb(51 65 85) !important; /* border-slate-700 */
        min-height: 42px !important;
        padding: 2px 8px !important;
    }
    
    /* Focus State */
    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border-color: rgb(59 130 246) !important; /* focus:border-blue-500 */
        outline: 0;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
    }

    /* Selected Item Tags */
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: rgb(51 65 85) !important; /* bg-slate-700 */
        border: none !important;
        border-radius: 0.375rem !important;
        padding: 8px 12px !important;
        margin: 4px !important;
        align-items: center !important;
        gap: 4px !important;
    }

    /* Remove (X) Button in Tags */
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {

        border: none !important;
        background: none !important;
        padding: 0 !important;
        margin: 0 !important;
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
    
        color: rgb(239 68 68) !important; /* text-red-500 */
    }

    /* Dropdown Styles */
    .select2-dropdown {
        background-color: rgb(15 23 42) !important; /* bg-slate-900 */
        border: 1px solid rgb(51 65 85) !important; /* border-slate-700 */
        border-radius: 0.5rem !important;
        margin-top: 4px !important;
    }

    /* Search Field */
    .select2-container--default .select2-search--dropdown .select2-search__field {
        background-color: rgb(30 41 59) !important; /* bg-slate-800 */
        border: 1px solid rgb(71 85 105) !important; /* border-slate-600 */
        border-radius: 0.375rem !important;
        padding: 8px 12px !important;
        margin: 8px !important;
        width: calc(100% - 16px) !important;
    }

    .select2-container--default .select2-search--dropdown .select2-search__field:focus {
        outline: none !important;
        border-color: rgb(59 130 246) !important; /* focus:border-blue-500 */
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2) !important;
    }

    /* Dropdown Options */


    /* Option Hover */
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: rgb(30 41 59) !important; /* bg-slate-800 */
    }

    /* Selected Option in Dropdown */
    .select2-container--default .select2-results__option[aria-selected=true] {
        background-color: transparent !important;
        position: relative !important;
        padding-left: 32px !important;
    }

    .select2-container--default .select2-results__option[aria-selected=true]::before {
        content: '✓' !important;
        position: absolute !important;
        left: 12px !important;
        color: rgb(34 197 94) !important; /* text-green-500 */
    }
    /* Results Group */
    .select2-results__group {
        padding: 6px 12px !important;
        font-weight: 600 !important;
    }
</style>

    
    <div class="space-y-6">
        <!-- Sizes -->
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">Sizes</label>
            <select id="sizes" 
                    name="attributes[sizes][]" 
                    multiple
                    class="select2-multiple w-full">
                @foreach($sizes as $size)
                    <option value="{{ $size->id }}"
                            {{ in_array($size->id, old('attributes.sizes', $product->attributes?->sizes ?? [])) ? 'selected' : '' }}>
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
                            {{ in_array($color->id, old('attributes.colors', $product->attributes?->colors ?? [])) ? 'selected' : '' }}>
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
                            {{ in_array($quality->id, old('attributes.qualities', $product->attributes?->qualities ?? [])) ? 'selected' : '' }}>
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
                            {{ in_array($type->id, old('attributes.types', $product->attributes?->types ?? [])) ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
            @error('attributes.types')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
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
                // Prevent focusout when selecting multiple items
                $(this).parents('.select2-container').find('.select2-search__field').blur();
            });
        });
    </script>



                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Update Product
                        </button>
                    </div>
                </div>
            </form>
            <div class="upload-section p-4 bg-gray-800 rounded-lg">
                <h3 class="text-lg font-medium text-gray-200 mb-4">Upload Product Images</h3>
                <form action="{{ route('products.uploadImage', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="images" class="block text-gray-300 mb-2">Choose Images</label>
                        <input 
                            type="file" 
                            name="images[]" 
                            id="images" 
                            multiple 
                            accept="image/*"
                            class="block w-full text-sm text-gray-300
                                   file:mr-4 file:py-2 file:px-4
                                   file:rounded-lg file:border-0
                                   file:text-sm file:font-medium
                                   file:bg-gray-700 file:text-gray-300
                                   hover:file:bg-gray-600"
                        >
                    </div>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                        Upload
                    </button>
                </form>
            </div>
    
            <div class="product-images">
                <h3 class="text-lg font-medium text-gray-300 mb-4">Supporting Images</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($product->productImages as $image)
                        <div class="relative group">
                            <!-- Image Preview -->
                            <div class="aspect-square overflow-hidden rounded-lg border border-slate-700">
                                <img 
                                    src="{{ asset('storage/' . $image->image) }}" 
                                    alt="Supporting Image" 
                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                />
                            </div>
                            <!-- Delete Button -->
                            <button
                                type="button"
                                onclick="openDeleteModal('{{ route('product-images.destroy', $image->id) }}', '{{ asset('storage/' . $image->image) }}')"
                                class="absolute top-2 right-2 bg-red-500 hover:bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        
            <!-- Custom Delete Modal -->
            <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center">
                <div class="bg-gray-800 rounded-lg p-6 max-w-md w-full mx-4 transform transition-all">
                    <div class="text-center">
                        <!-- Preview of image to be deleted -->
                        <div class="mb-4">
                            <img id="deleteImagePreview" src="" alt="Image to delete" class="w-32 h-32 object-cover rounded-lg mx-auto border border-gray-700"/>
                        </div>
                        
                        <h3 class="text-xl font-bold text-gray-200 mb-2">Confirm Deletion</h3>
                        <p class="text-gray-300 mb-6">Are you sure you want to delete this image? This action cannot be undone.</p>
                        
                        <div class="flex justify-center space-x-4">
                            <button
                                type="button"
                                onclick="closeDeleteModal()"
                                class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition-colors duration-200">
                                Cancel
                            </button>
                            <button
                                type="button"
                                id="confirmDeleteBtn"
                                class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors duration-200">
                                Delete Image
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- Enhanced Delete Script -->
            <script>
                let currentDeleteUrl = '';
                const modal = document.getElementById('deleteModal');
                const imagePreview = document.getElementById('deleteImagePreview');
        
                function openDeleteModal(deleteUrl, imageUrl) {
                    currentDeleteUrl = deleteUrl;
                    imagePreview.src = imageUrl;
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    // Add fade-in animation
                    modal.animate([
                        { opacity: 0 },
                        { opacity: 1 }
                    ], {
                        duration: 200,
                        easing: 'ease-out'
                    });
                }
        
                function closeDeleteModal() {
                    // Add fade-out animation
                    const animation = modal.animate([
                        { opacity: 1 },
                        { opacity: 0 }
                    ], {
                        duration: 200,
                        easing: 'ease-in'
                    });
        
                    animation.onfinish = () => {
                        modal.classList.add('hidden');
                        modal.classList.remove('flex');
                    };
                }
        
                // Close modal when clicking outside
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        closeDeleteModal();
                    }
                });
        
                // Handle delete confirmation
                document.getElementById('confirmDeleteBtn').addEventListener('click', () => {
                    // Show loading state
                    const btn = document.getElementById('confirmDeleteBtn');
                    const originalText = btn.innerText;
                    btn.disabled = true;
                    btn.innerHTML = `
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    `;
        
                    // Send delete request
                    fetch(currentDeleteUrl, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                        },
                    })
                    .then(response => {
                        if (response.ok) {
                            // Add success feedback before reload
                            const modalContent = modal.querySelector('.bg-gray-800');
                            modalContent.innerHTML = `
                                <div class="text-center p-6">
                                    <svg class="mx-auto h-12 w-12 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <h3 class="mt-2 text-xl font-medium text-gray-200">Image Deleted Successfully</h3>
                                </div>
                            `;
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        } else {
                            throw new Error('Failed to delete');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        btn.disabled = false;
                        btn.innerText = originalText;
                        alert('Failed to delete the image. Please try again.');
                    });
                });
            </script>
        </div>


        
    </div>

    <!-- Add this script section at the end of your layout or form -->
    <script>
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
    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js" referrerpolicy="origin"></script>
<script>
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
            // Save content to textarea when submitting the form
            editor.on('change', function() {
                editor.save();
            });
        },
        content_style: `
            body {
                background-color: #1e293b; /* slate-800 */
                color: #d1d5db; /* gray-300 */
            }
            .mce-content-body[data-mce-placeholder]:not(.mce-visualblocks)::before {
                color: #9ca3af; /* gray-400 */
            }
        `,
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('category_id');
        const subcategorySelect = document.getElementById('subcategory_id');

        function fetchSubcategories(categoryId, selectedSubcategoryId = null) {
            // Clear current options except the first one
            subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';
            
            if (!categoryId) return;

            // Show loading state
            subcategorySelect.disabled = true;
            
            fetch(`/api/categories/${categoryId}/subcategories`)
                .then(response => response.json())
                .then(subcategories => {
                    subcategories.forEach(subcategory => {
                        const option = new Option(
                            subcategory.name, 
                            subcategory.id,
                            false,
                            subcategory.id == selectedSubcategoryId
                        );
                        subcategorySelect.add(option);
                    });
                })
                .catch(error => console.error('Error:', error))
                .finally(() => {
                    subcategorySelect.disabled = false;
                });
        }

        // Initial load of subcategories if category is selected
        if (categorySelect.value) {
            fetchSubcategories(categorySelect.value, '{{ $product->subcategory_id }}');
        }

        // Update subcategories when category changes
        categorySelect.addEventListener('change', (e) => {
            fetchSubcategories(e.target.value);
        });
    });
</script>
</x-admin-layout>