<x-admin-layout>
    <div class="container mx-auto px-4 py-8">
        <div id="toaster" class="fixed top-4 right-4 z-50 space-y-2"></div>


        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-white">Edit Category</h1>
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


        <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="bg-slate-800 rounded-lg p-6">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-white mb-2">Category Name</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    value="{{ old('name', $category->name) }}"
                    class="w-full bg-slate-700 text-white border border-slate-600 rounded px-3 py-2 @error('name') border-red-500 @enderror"
                >
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-white mb-2">Description </label>
                <textarea 
                    name="description" 
                    id="description" 
                    class="w-full bg-slate-700 text-white border border-slate-600 rounded px-3 py-2" reqiured
                >{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="block text-white mb-2">Category Image </label>
                <input 
                    type="file" 
                    name="image" 
                    id="image"
                    class="w-full bg-slate-700 text-white border border-slate-600 rounded px-3 py-2" reqiured
                >
                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                @if($category->image)
                    <div class="mt-2">
                        <p class="text-white mb-2">Current Image:</p>
                        <img 
                            src="{{ Storage::url($category->image) }}" 
                            alt="{{ $category->name }}" 
                            class="h-32 w-auto rounded"
                        >
                    </div>
                @endif
            </div>

            <div class="flex justify-end">
                <button 
                    type="submit" 
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
                >
                    Update Category
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