<div id="images-tab" class="tab-content hidden">
    <!-- Image upload section -->
    <div class="space-y-6">
        <div class="grid  gap-6">

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
        </div>


    </div>
</div>