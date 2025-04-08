<x-admin-layout>
    <div class="mt-4 sm:mt-6 container mx-auto px-4 mb-8">
        <!-- Header section - Improved with better gradient and spacing -->
        <div class="bg-gradient-to-r from-slate-800 to-slate-900 rounded-t-lg border border-slate-700 shadow-lg p-6 flex flex-col sm:flex-row justify-between items-center gap-4">
            <h3 class="text-2xl font-bold text-white flex items-center">
                <i class="fa-solid fa-pen-to-square text-blue-400 mr-3"></i>
                Edit Product
            </h3>
            <a href="{{ route('products.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white rounded-lg transition-colors shadow-md">
                <i class="fa-solid fa-arrow-left mr-2"></i>
                Back to Products
            </a>
        </div>
        
        <!-- Form body with tabs - Improved spacing and transitions -->
        <div class="bg-slate-800 rounded-b-lg border-x border-b border-slate-700 shadow-lg">
            <!-- Tab navigation - Enhanced with better hover states -->
            <div class="border-b border-slate-700">
                <nav class="flex overflow-x-auto" aria-label="Form Sections">
                    <button type="button" class="tab-button active py-4 px-6 text-blue-400 border-b-2 border-blue-400 font-medium text-sm transition-all duration-200" data-tab="basics">
                        <i class="fa-solid fa-info-circle mr-2"></i>Basic Info
                    </button>
                    <button type="button" class="tab-button py-4 px-6 text-gray-400 hover:text-gray-300 font-medium text-sm transition-all duration-200" data-tab="attributes">
                        <i class="fa-solid fa-tags mr-2"></i>Attributes
                    </button>
                    <button type="button" class="tab-button py-4 px-6 text-gray-400 hover:text-gray-300 font-medium text-sm transition-all duration-200" data-tab="pricing">
                        <i class="fa-solid fa-dollar-sign mr-2"></i>Pricing
                    </button>
                    <button type="button" class="tab-button py-4 px-6 text-gray-400 hover:text-gray-300 font-medium text-sm transition-all duration-200" data-tab="description">
                        <i class="fa-solid fa-align-left mr-2"></i>Description
                    </button>
                    <button type="button" class="tab-button py-4 px-6 text-gray-400 hover:text-gray-300 font-medium text-sm transition-all duration-200" data-tab="images">
                        <i class="fa-solid fa-images mr-2"></i>Images
                    </button>
                </nav>
            </div>

            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                @method('PUT')
                <x-admin.basic-info :categories="$categories" :product="$product"/>
                <x-admin.attributes :sizes="$sizes" :colors="$colors" :qualities="$qualities" :types="$types" :product="$product" />
                <x-admin.pricing :product="$product"/>
                <x-admin.description :product="$product" />
                <x-admin.products.images :product="$product" />
                <input type="hidden" name="pricing_data" id="pricing_data" value="{{ old('pricing_data', json_encode($product->attributes->prices ?? [])) }}">


                <!-- Form Footer - Enhanced with better status indicators -->
                <div class="mt-8 pt-6 border-t border-slate-700 flex justify-between items-center">
                    <div class="flex items-center">
                        <div class="flex flex-col">
                            <div class="text-xs font-medium text-gray-400 uppercase tracking-wider">Required fields</div>
                            <div class="flex items-center text-xs text-gray-400 mt-2">
                                <i class="fa-solid fa-circle text-red-500 mr-1 text-xs"></i>
                                <span>Missing</span>
                                <i class="fa-solid fa-circle text-green-500 ml-3 mr-1 text-xs"></i>
                                <span>Complete</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex space-x-3">
                        <button type="button" id="prev-tab-btn" class="hidden inline-flex items-center px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white rounded-lg transition-colors shadow-md">
                            <i class="fa-solid fa-chevron-left mr-2"></i>
                            Previous
                        </button>
                        
                        <button type="button" id="next-tab-btn" class="inline-flex items-center px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors shadow-md">
                            Next
                            <i class="fa-solid fa-chevron-right ml-2"></i>
                        </button>
                        
                        <button type="submit" id="submit-btn" class="hidden inline-flex items-center px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors shadow-md">
                            <i class="fa-solid fa-check mr-2"></i>
                            Update Product
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Upload Section - Improved with better UI elements -->
    <div class="container mx-auto px-4 mb-8">
        <div class="upload-section p-6 bg-slate-800 rounded-lg border border-slate-700 shadow-lg mt-6">
            <h3 class="text-lg font-medium text-gray-200 mb-4 flex items-center">
                <i class="fa-solid fa-cloud-upload-alt text-blue-400 mr-2"></i>
                Upload Product Images
            </h3>
            <form action="{{ route('products.uploadImage', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="images" class="block text-gray-300 mb-2">Choose Images</label>
                    <div class="flex flex-col items-center justify-center w-full px-4 py-6 border-2 border-dashed border-slate-600 rounded-lg hover:bg-slate-700/30 transition-colors cursor-pointer">
                        <i class="fa-solid fa-images text-3xl text-gray-400 mb-3"></i>
                        <p class="text-sm text-gray-400 mb-2">Drag and drop your images here, or click to browse</p>
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
                                file:bg-blue-600 file:text-white
                                hover:file:bg-blue-500 cursor-pointer"
                        >
                    </div>
                </div>
                <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center">
                    <i class="fa-solid fa-upload mr-2"></i>
                    Upload Images
                </button>
            </form>
        </div>
    </div>

    <!-- Delete Modal - Enhanced with animations and better design -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center backdrop-blur-sm">
        <div class="bg-slate-800 rounded-lg shadow-xl max-w-md w-full p-6 border border-slate-700">
            <div class="text-center mb-4">
                <i class="fa-solid fa-triangle-exclamation text-yellow-500 text-4xl mb-4"></i>
                <h3 class="text-xl font-medium text-gray-200">Delete Image</h3>
                <p class="mt-2 text-gray-400">Are you sure you want to delete this image? This action cannot be undone.</p>
            </div>
            
            <div class="mt-4 mb-6 bg-slate-900 p-2 rounded-lg border border-slate-700">
                <img id="deleteImagePreview" src="" alt="Image to delete" class="w-full h-auto rounded mx-auto">
            </div>
            
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white rounded-lg transition-colors">
                    <i class="fa-solid fa-xmark mr-2"></i>Cancel
                </button>
                <button type="button" id="confirmDeleteBtn" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                    <i class="fa-solid fa-trash-alt mr-2"></i>Delete
                </button>
            </div>
        </div>
    </div>

    <!-- Scripts Section -->
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

    <!-- TinyMCE Editor Script -->
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
                    padding: 20px;
                    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', sans-serif;
                }
                .mce-content-body[data-mce-placeholder]:not(.mce-visualblocks)::before {
                    color: #9ca3af; /* gray-400 */
                }
            `,
        });
    </script>


    <!-- Include custom scripts component -->
    <x-admin.scripts :product="$product" />
</x-admin-layout>