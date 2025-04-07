<x-admin-layout>
    <div class="mt-4 sm:mt-6 container mx-auto px-4 mb-8">
        <!-- Header section -->
        <div class="bg-gradient-to-r from-slate-800 to-slate-900 rounded-t-lg border border-slate-700 shadow-lg p-5 flex flex-col sm:flex-row justify-between items-center gap-4">
            <h3 class="text-xl font-bold text-white flex items-center">
                <i class="fas fa-edit h-6 w-6 mr-2 text-blue-400"></i>
                Edit Product
            </h3>
            <a href="{{ route('products.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white rounded-lg transition-colors shadow-md">
                <i class="fas fa-arrow-left h-5 w-5 mr-2"></i>
                Back to Products
            </a>
        </div>
        

        <!-- Form body with tabs -->
        <div class="bg-slate-800 rounded-b-lg border-x border-b border-slate-700 shadow-lg">
            <!-- Tab navigation -->
            <div class="border-b border-slate-700">
                <nav class="flex overflow-x-auto" aria-label="Form Sections">
                    <button type="button" class="tab-button active py-4 px-6 text-blue-400 border-b-2 border-blue-400 font-medium text-sm" data-tab="basics">
                        Basic Info
                    </button>
                    <button type="button" class="tab-button py-4 px-6 text-gray-400 hover:text-gray-300 font-medium text-sm" data-tab="attributes">
                        Attributes
                    </button>
                    <button type="button" class="tab-button py-4 px-6 text-gray-400 hover:text-gray-300 font-medium text-sm" data-tab="pricing">
                        Pricing
                    </button>
                    <button type="button" class="tab-button py-4 px-6 text-gray-400 hover:text-gray-300 font-medium text-sm" data-tab="description">
                        Description
                    </button>
                    <button type="button" class="tab-button py-4 px-6 text-gray-400 hover:text-gray-300 font-medium text-sm" data-tab="images">
                        Images
                    </button>
                </nav>
            </div>

            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="p-5">
                @csrf
                @method('PUT')
                <x-admin.basic-info :categories="$categories" :product="$product"/>
                <x-admin.attributes :sizes="$sizes" :colors="$colors" :qualities="$qualities" :types="$types" :product="$product" />
                <x-admin.pricing :product="$product"/>
                <x-admin.description :product="$product" />
                <div id="images" class="tab-content hidden">
                    <!-- Image upload section -->
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Main Image -->
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Main Product Image</label>
                                <div class="relative h-32 w-32">
                                    <img id="imagePreview" 
                                         src="{{ asset('storage/' . $product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="h-32 w-32 object-cover rounded-lg border border-slate-700">
                                </div>
                                <input type="file" 
                                       id="image" 
                                       name="image" 
                                       accept="image/*"
                                       class="mt-2 block w-full text-sm text-gray-300
                                              file:mr-4 file:py-2 file:px-4
                                              file:rounded-lg file:border-0
                                              file:text-sm file:font-semibold
                                              file:bg-slate-700 file:text-gray-300
                                              hover:file:bg-slate-600
                                              file:cursor-pointer cursor-pointer">
                            </div>

                            <!-- Supporting Images -->
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-2">Supporting Images</label>
                                <div class="grid grid-cols-2 gap-4">
                                    @foreach($product->productImages as $image)
                                        <div class="relative group">
                                            <img src="{{ asset('storage/' . $image->image) }}"
                                                 class="h-20 w-20 object-cover rounded-lg border border-slate-700"
                                                 alt="Supporting Image">
                                            <button type="button"
                                                    onclick="openDeleteModal('{{ route('product-images.destroy', $image->id) }}', '{{ asset('storage/' . $image->image) }}')"
                                                    class="absolute top-1 right-1 bg-red-500 hover:bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Additional Images Upload -->
                        <div class="mt-4">
                            <input type="file" 
                                   name="images[]" 
                                   multiple 
                                   accept="image/*"
                                   class="block w-full text-sm text-gray-300
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-lg file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-slate-700 file:text-gray-300
                                          hover:file:bg-slate-600
                                          file:cursor-pointer cursor-pointer">
                        </div>
                    </div>
                </div>

                <!-- Form Footer -->
                <div class="mt-8 pt-6 border-t border-slate-700 flex justify-between items-center">
                    <div class="flex items-center">
                        <div class="flex flex-col">
                            <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Required fields</div>
                            <div class="flex items-center text-xs text-gray-400 mt-1">
                                <span class="h-2 w-2 bg-red-500 rounded-full mr-1"></span>
                                <span>Missing</span>
                                <span class="h-2 w-2 bg-green-500 rounded-full ml-3 mr-1"></span>
                                <span>Complete</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex space-x-3">
                        <button type="button" id="prev-tab-btn" class="hidden inline-flex items-center px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white rounded-lg transition-colors shadow-md">
                            <i class="fas fa-chevron-left h-5 w-5 mr-2"></i>
                            Previous
                        </button>
                        
                        <button type="button" id="next-tab-btn" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors shadow-md">
                            Next
                            <i class="fas fa-chevron-right h-5 w-5 ml-2"></i>
                        </button>
                        
                        <button type="submit" id="submit-btn" class="hidden inline-flex items-center px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors shadow-md">
                            <i class="fas fa-check h-5 w-5 mr-2"></i>
                            Update Product
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

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
<!-- Scripts -->
<x-admin.scripts :product="$product" />
</x-admin-layout>