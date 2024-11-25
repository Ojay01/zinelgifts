<!-- resources/views/admin/categories/index.blade.php -->
<x-admin-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 mt-4 sm:mt-6">
        <div id="toaster" class="fixed top-4 right-4 z-50 space-y-2"></div>

        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md border border-slate-200 dark:border-slate-700">
            <div class="p-4 sm:p-6 flex flex-col sm:flex-row justify-between items-center border-b border-slate-100 dark:border-slate-700">
                <h3 class="text-lg sm:text-xl font-bold text-slate-800 dark:text-white mb-3 sm:mb-0">
                    Product Categories
                </h3>
                <a href="{{ route('categories.create') }}" 
                   class="w-full sm:w-auto text-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                    Add New Category
                </a>
            </div>

            <div class="max-w-full overflow-x-auto border rounded-lg shadow-md">
                <table class="min-w-full table-auto border-collapse border border-slate-300 dark:border-slate-600">
                    <thead class="bg-slate-50 dark:bg-slate-700/50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-300 uppercase tracking-wider">
                                Thumbnail
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-300 uppercase tracking-wider">
                                Name
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-300 uppercase tracking-wider hidden lg:table-cell">
                                Description
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-300 uppercase tracking-wider hidden md:table-cell lg:hidden xl:table-cell">
                                Subcategories
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-300 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @forelse($categories as $category)
                        <tr x-data="{ showModal: false }" class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                            <td class="px-4 py-4 whitespace-nowrap">
                                <img 
                                    src="{{ $category->image ? asset('storage/' . $category->image) : asset('default-category.png') }}" 
                                    alt="{{ $category->name }} thumbnail" 
                                    class="w-16 h-16 object-cover rounded-md"
                                >
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-slate-900 dark:text-white">
                                    {{ $category->name }}
                                </div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap hidden lg:table-cell">
                                <div class="text-sm text-slate-500 dark:text-slate-300 truncate max-w-xs">
                                    {{ $category->description }}
                                </div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap hidden md:table-cell lg:hidden xl:table-cell">
                                <a href="{{ route('subcat', $category->id) }}" 
                                   class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm transition-colors">
                                    {{ $category->subcategories_count }} Subcategories
                                </a>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="flex space-x-3">
                                    <a href="{{ route('categories.edit', $category->id) }}" 
                                       class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm transition-colors">
                                        Edit
                                    </a>
                                    <button 
                                        @click="showModal = true"
                                        class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 text-sm transition-colors"
                                    >
                                        Delete
                                    </button>

                                    <!-- Delete Confirmation Modal -->
                                    <div 
                                        x-show="showModal" 
                                        @click.self="showModal = false"
                                        x-transition:enter="ease-out duration-300"
                                        x-transition:enter-start="opacity-0"
                                        x-transition:enter-end="opacity-100"
                                        x-transition:leave="ease-in duration-200"
                                        x-transition:leave-start="opacity-100"
                                        x-transition:leave-end="opacity-0"
                                        class="fixed inset-0 z-50 flex items-center justify-center overflow-x-hidden overflow-y-auto outline-none focus:outline-none bg-black/30 backdrop-blur-sm"
                                        >
                                        <div    @click.stop class="relative w-auto max-w-sm mx-auto my-6">
                                            <div class="relative flex flex-col w-full bg-white dark:bg-slate-800 border-0 rounded-lg shadow-lg outline-none focus:outline-none">
                                                <div class="flex items-start justify-between p-5 border-b border-solid rounded-t border-slate-200 dark:border-slate-700">
                                                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white">
                                                        Confirm Deletion
                                                    </h3>
                                                    <button 
                                                        @click="showModal = false"
                                                        class="float-right text-slate-400 hover:text-slate-600"
                                                    >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M18 6 6 18"/>
                                                        <path d="m6 6 12 12"/>
                                                    </svg>
                                                    </button>
                                                </div>
                                                <div class="relative flex-auto p-6 w-full max-w-full overflow-hidden">
                                                    <p class="mb-4 text-slate-500 dark:text-slate-300 text-sm leading-relaxed break-words">
                                                        Are you sure you want to delete this category? <br/>
                                                        <strong>All subcategories will also be deleted.</strong>
                                                    </p>
                                                </div>
                                                <div class="flex items-center justify-end p-6 border-t border-solid rounded-b border-slate-200 dark:border-slate-700">
                                                    <button 
                                                        @click="showModal = false"
                                                        class="px-4 py-2 mb-1 mr-3 text-sm font-bold text-slate-600 dark:text-slate-300 uppercase transition-all duration-150 ease-linear bg-transparent rounded-lg hover:bg-slate-200 dark:hover:bg-slate-700 outline-none focus:outline-none"
                                                    >
                                                        Cancel
                                                    </button>
                                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button 
                                                            type="submit"
                                                            class="px-4 py-2 mb-1 text-sm font-bold text-white uppercase bg-red-600 rounded-lg hover:bg-red-700 transition-all duration-150 ease-linear"
                                                        >
                                                        
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-4 text-center text-slate-500 dark:text-slate-400">
                                No categories found. 
                                <a href="{{ route('categories.create') }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                                    Create your first category
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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