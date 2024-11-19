<x-admin-layout>
    <div class="container mx-auto px-4 py-8">
        <!-- Toaster Notification Container -->
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
            
            <!-- Rest of the form remains the same as previous version -->
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

       
            <div>
                <label for="description" class="block text-white mb-2 font-semibold">Description </label>
                <textarea 
                    name="description" 
                    id="description" 
                    rows="4"
                    class="w-full bg-slate-700 text-white border-2 border-slate-600 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 " required
                >{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="image" class="block text-white mb-2 font-semibold">Category Image </label>
                <div class="flex items-center space-x-4">
                    <input 
                        type="file" 
                        name="image" 
                        id="image"
                        accept="image/*"
                        class="w-full bg-slate-700 text-white border-2 border-slate-600 rounded-md px-4 py-3 file:mr-4 file:rounded-md file:border-0 file:bg-blue-500 file:text-white file:px-4 file:py-2 hover:file:bg-blue-600"
                        onchange="previewImage(event)"
                    >
                </div>
                @error('image')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror

                <div id="image-preview" class="mt-4 hidden">
                    <img id="preview" class="max-w-xs max-h-48 rounded-lg shadow-md" />
                </div>
            </div>

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
        // Check for success or error messages from server
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                createToast('{{ session('success') }}', 'success');
            @endif

            @if($errors->any())
                @foreach($errors->all() as $error)
                    createToast('{{ $error }}', 'error');
                @endforeach
            @endif
        });

        // Image preview function
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('image-preview');
            
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

        // Toaster notification function
        function createToast(message, type = 'info') {
            const toaster = document.getElementById('toaster');
            
            // Create toast element
            const toast = document.createElement('div');
            toast.className = `
                p-4 rounded-lg shadow-lg transform transition-all duration-300 ease-in-out 
                ${type === 'success' ? 'bg-green-600' : 'bg-red-600'} 
                text-white flex items-center justify-between
            `;
            
            // Toast content
            toast.innerHTML = `
                <span class="mr-4">${message}</span>
                <button onclick="this.parentElement.remove()" class="ml-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            `;

            // Add to toaster
            toaster.appendChild(toast);

            // Auto-dismiss after 5 seconds
            setTimeout(() => {
                toast.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => toast.remove(), 300);
            }, 5000);
        }
    </script>
</x-admin-layout>