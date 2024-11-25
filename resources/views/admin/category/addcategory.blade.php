<x-admin-layout>
    <div class="container mx-auto px-4 py-8">
        <div id="toaster" class="fixed top-4 right-4 z-50 space-y-2"></div>

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-white">Create Category</h1>
            <a 
                href="{{ route('categories.index') }}" 
                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md transition duration-300 flex items-center"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h4a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h4a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                </svg>
                 Categories
            </a>
        </div>
        <form 
            action="{{ route('admin.categories.store') }}" 
            method="POST" 
            enctype="multipart/form-data" 
            class="bg-slate-800 rounded-xl shadow-lg p-8 space-y-6"
        >
            @csrf
            
            <!-- Category Name Input -->
            <div>
                <label for="name" class="block text-white mb-2 font-semibold">Category Name <span class="text-red-500">*</span></label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    value="{{ old('name') }}"
                    required
                    class="w-full bg-slate-700 text-white border-2 border-slate-600 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 @error('name') border-red-500 @enderror"
                >
                @error('name')
                    <p class="text-red-400 text-sm mt-2 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Description Input -->
            <div>
                <label for="description" class="block text-white mb-2 font-semibold">Description </label>
                <textarea 
                    name="description" 
                    id="description" 
                    rows="4"
                    class="w-full bg-slate-700 text-white border-2 border-slate-600 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300" 
                    required
                >{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Thumbnail Upload -->
            <div>
                <label for="thumbnail" class="block text-white mb-2 font-semibold">Category Thumbnail</label>
                <div class="flex flex-col space-y-4">
                    <input 
                        type="file" 
                        name="image" 
                        id="thumbnail"
                        accept="image/*"
                        class="w-full bg-slate-700 text-white border-2 border-slate-600 rounded-md px-4 py-3 file:mr-4 file:rounded-md file:border-0 file:bg-blue-500 file:text-white file:px-4 file:py-2 hover:file:bg-blue-600"
                        onchange="previewThumbnail(event)"
                    >
                    
                    <!-- Thumbnail Preview -->
                    <div id="thumbnail-preview" class="mt-4 hidden">
                        <img 
                            id="preview" 
                            class="max-w-xs max-h-48 object-cover rounded-lg shadow-md" 
                            alt="Thumbnail Preview"
                        />
                    </div>
                </div>
                @error('thumbnail')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end space-x-4">
                <button 
                    type="reset" 
                    class="bg-slate-600 hover:bg-slate-700 text-white px-6 py-3 rounded-md transition duration-300"
                >
                    Reset
                </button>
                <button 
                    type="submit" 
                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-md transition duration-300 flex items-center"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                    </svg>
                    Create Category
                </button>
            </div>
        </form>
    </div>

    <script>
        // Image preview function
        function previewThumbnail(event) {
            const input = event.target;
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('thumbnail-preview');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }
                
                reader.readAsDataURL(input.files[0]);
            } else {
                previewContainer.classList.add('hidden');
            }
        }
    </script>
</x-admin-layout>