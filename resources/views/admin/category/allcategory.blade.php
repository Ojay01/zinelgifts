<!-- resources/views/admin/categories/index.blade.php -->
<x-admin-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 mt-4 sm:mt-6">
        <div id="toaster" class="fixed top-4 right-4 z-50 space-y-2"></div>

        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md border border-slate-200 dark:border-slate-700">
            <div class="p-4 sm:p-6 flex flex-col sm:flex-row justify-between items-center border-b border-slate-100 dark:border-slate-700">
                <h3 class="text-lg sm:text-xl font-bold text-slate-800 dark:text-white mb-3 sm:mb-0">
                    <i class="fas fa-tags mr-2"></i> Product Categories
                </h3>
                <a href="{{ route('categories.create') }}" 
                   class="w-full sm:w-auto text-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                    <i class="fas fa-plus-circle mr-1"></i> Add New Category
                </a>
            </div>

            <div class="p-3 flex justify-between items-center border-b border-slate-100 dark:border-slate-700 bg-slate-50 dark:bg-slate-700/30">
                <div class="relative w-64">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                    <input type="text" id="categorySearch" placeholder="Search categories..." 
                           class="w-full pl-10 pr-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-slate-700 dark:text-white text-sm">
                </div>
                <div class="flex items-center space-x-2">
                    <span class="text-sm text-slate-500 dark:text-slate-300">View:</span>
                    <button id="gridViewBtn" class="p-2 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-600 text-blue-600 dark:text-blue-400">
                        <i class="fas fa-th-large"></i>
                    </button>
                    <button id="listViewBtn" class="p-2 rounded-lg hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-400 dark:text-slate-500">
                        <i class="fas fa-list"></i>
                    </button>
                </div>
            </div>

            <!-- Table View (Default) -->
            <div id="tableView" class="max-w-full overflow-x-auto">
                <table class="min-w-full table-auto border-collapse">
                    <thead class="bg-slate-50 dark:bg-slate-700/50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-300 uppercase tracking-wider">
                                <i class="fas fa-image mr-1"></i> Thumbnail
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-300 uppercase tracking-wider">
                                <i class="fas fa-tag mr-1"></i> Name
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-300 uppercase tracking-wider hidden lg:table-cell">
                                <i class="fas fa-align-left mr-1"></i> Description
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-300 uppercase tracking-wider hidden md:table-cell lg:hidden xl:table-cell">
                                <i class="fas fa-layer-group mr-1"></i> Subcategories
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-300 uppercase tracking-wider">
                                <i class="fas fa-cog mr-1"></i> Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @forelse($categories as $category)
                        <tr x-data="{ showModal: false }" class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="w-16 h-16 overflow-hidden rounded-md border border-slate-200 dark:border-slate-600 flex items-center justify-center">
                                    <img 
                                        src="{{ $category->image ? asset('storage/' . $category->image) : asset('default-category.png') }}" 
                                        alt="{{ $category->name }} thumbnail" 
                                        class="w-full h-full object-cover"
                                    >
                                </div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-slate-900 dark:text-white">
                                    {{ $category->name }}
                                </div>
                                <div class="text-xs text-slate-500 dark:text-slate-400 md:hidden">
                                    {{ $category->subcategories_count }} subcategories
                                </div>
                            </td>
                            <td class="px-4 py-4 hidden lg:table-cell">
                                <div class="text-sm text-slate-500 dark:text-slate-300 line-clamp-2 max-w-xs">
                                    {{ $category->description }}
                                </div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap hidden md:table-cell lg:hidden xl:table-cell">
                                <a href="{{ route('subcat', $category->id) }}" 
                                   class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm transition-colors flex items-center">
                                    <span class="bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 px-2 py-1 rounded-md">
                                        {{ $category->subcategories_count }}
                                    </span>
                                    <span class="ml-2">Subcategories</span>
                                </a>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="flex space-x-3">
                                    <a href="{{ route('categories.edit', $category->id) }}" 
                                       class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm transition-colors">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                    <button 
                                        @click="showModal = true"
                                        class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 text-sm transition-colors"
                                    >
                                        <i class="fas fa-trash-alt mr-1"></i> Delete
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
                                        <div @click.stop class="relative w-auto max-w-sm mx-auto my-6">
                                            <div class="relative flex flex-col w-full bg-white dark:bg-slate-800 border-0 rounded-lg shadow-lg outline-none focus:outline-none">
                                                <div class="flex items-start justify-between p-5 border-b border-solid rounded-t border-slate-200 dark:border-slate-700">
                                                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white flex items-center">
                                                        <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
                                                        Confirm Deletion
                                                    </h3>
                                                    <button 
                                                        @click="showModal = false"
                                                        class="float-right text-slate-400 hover:text-slate-600 dark:hover:text-slate-300"
                                                    >
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                                <div class="relative flex-auto p-6 w-full max-w-full overflow-hidden">
                                                    <p class="mb-4 text-slate-500 dark:text-slate-300 text-sm leading-relaxed break-words">
                                                        Are you sure you want to delete <strong>"{{ $category->name }}"</strong>? <br/>
                                                        <span class="flex items-center mt-2 text-red-500">
                                                            <i class="fas fa-exclamation-circle mr-2"></i>
                                                            All subcategories will also be deleted.
                                                        </span>
                                                    </p>
                                                </div>
                                                <div class="flex items-center justify-end p-6 border-t border-solid rounded-b border-slate-200 dark:border-slate-700">
                                                    <button 
                                                        @click="showModal = false"
                                                        class="px-4 py-2 mb-1 mr-3 text-sm font-bold text-slate-600 dark:text-slate-300 uppercase transition-all duration-150 ease-linear bg-transparent rounded-lg hover:bg-slate-200 dark:hover:bg-slate-700 outline-none focus:outline-none flex items-center"
                                                    >
                                                        <i class="fas fa-times mr-1"></i> Cancel
                                                    </button>
                                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button 
                                                            type="submit"
                                                            class="px-4 py-2 mb-1 text-sm font-bold text-white uppercase bg-red-600 rounded-lg hover:bg-red-700 transition-all duration-150 ease-linear flex items-center"
                                                        >
                                                            <i class="fas fa-trash-alt mr-1"></i> Delete
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
                            <td colspan="5" class="px-4 py-8 text-center text-slate-500 dark:text-slate-400">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-folder-open text-4xl mb-3 text-slate-300 dark:text-slate-600"></i>
                                    <p class="mb-2">No categories found.</p>
                                    <a href="{{ route('categories.create') }}" class="text-blue-600 dark:text-blue-400 hover:underline flex items-center">
                                        <i class="fas fa-plus-circle mr-1"></i> Create your first category
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Grid View (Hidden by default) -->
            <div id="gridView" class="hidden p-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @forelse($categories as $category)
                <div x-data="{ showModal: false }" class="bg-white dark:bg-slate-700 rounded-lg shadow-md border border-slate-200 dark:border-slate-600 overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="h-36 overflow-hidden relative">
                        <img 
                            src="{{ $category->image ? asset('storage/' . $category->image) : asset('default-category.png') }}" 
                            alt="{{ $category->name }} thumbnail" 
                            class="w-full h-full object-cover"
                        >
                        <div class="absolute top-2 right-2">
                            <span class="bg-blue-100 dark:bg-blue-900/70 text-blue-800 dark:text-blue-300 px-2 py-1 rounded-full text-xs">
                                <i class="fas fa-layer-group mr-1"></i> {{ $category->subcategories_count }}
                            </span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h4 class="font-medium text-slate-900 dark:text-white text-sm mb-1">{{ $category->name }}</h4>
                        <p class="text-slate-500 dark:text-slate-300 text-xs mb-3 line-clamp-2">{{ $category->description }}</p>
                        <div class="flex justify-between pt-2 border-t border-slate-100 dark:border-slate-600">
                            <a href="{{ route('categories.edit', $category->id) }}" 
                               class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-xs transition-colors">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                            <a href="{{ route('subcat', $category->id) }}" 
                               class="text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300 text-xs transition-colors">
                                <i class="fas fa-sitemap mr-1"></i> Subcategories
                            </a>
                            <button 
                                @click="showModal = true"
                                class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 text-xs transition-colors"
                            >
                                <i class="fas fa-trash-alt mr-1"></i> Delete
                            </button>
                            
                            <!-- Delete Modal (Same as in table view) -->
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
                                <div @click.stop class="relative w-auto max-w-sm mx-auto my-6">
                                    <div class="relative flex flex-col w-full bg-white dark:bg-slate-800 border-0 rounded-lg shadow-lg outline-none focus:outline-none">
                                        <div class="flex items-start justify-between p-5 border-b border-solid rounded-t border-slate-200 dark:border-slate-700">
                                            <h3 class="text-lg font-semibold text-slate-900 dark:text-white flex items-center">
                                                <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
                                                Confirm Deletion
                                            </h3>
                                            <button 
                                                @click="showModal = false"
                                                class="float-right text-slate-400 hover:text-slate-600 dark:hover:text-slate-300"
                                            >
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="relative flex-auto p-6 w-full max-w-full overflow-hidden">
                                            <p class="mb-4 text-slate-500 dark:text-slate-300 text-sm leading-relaxed break-words">
                                                Are you sure you want to delete <strong>"{{ $category->name }}"</strong>? <br/>
                                                <span class="flex items-center mt-2 text-red-500">
                                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                                    All subcategories will also be deleted.
                                                </span>
                                            </p>
                                        </div>
                                        <div class="flex items-center justify-end p-6 border-t border-solid rounded-b border-slate-200 dark:border-slate-700">
                                            <button 
                                                @click="showModal = false"
                                                class="px-4 py-2 mb-1 mr-3 text-sm font-bold text-slate-600 dark:text-slate-300 uppercase transition-all duration-150 ease-linear bg-transparent rounded-lg hover:bg-slate-200 dark:hover:bg-slate-700 outline-none focus:outline-none flex items-center"
                                            >
                                                <i class="fas fa-times mr-1"></i> Cancel
                                            </button>
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button 
                                                    type="submit"
                                                    class="px-4 py-2 mb-1 text-sm font-bold text-white uppercase bg-red-600 rounded-lg hover:bg-red-700 transition-all duration-150 ease-linear flex items-center"
                                                >
                                                    <i class="fas fa-trash-alt mr-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-10 text-center text-slate-500 dark:text-slate-400">
                    <div class="flex flex-col items-center">
                        <i class="fas fa-folder-open text-4xl mb-3 text-slate-300 dark:text-slate-600"></i>
                        <p class="mb-2">No categories found.</p>
                        <a href="{{ route('categories.create') }}" class="text-blue-600 dark:text-blue-400 hover:underline flex items-center">
                            <i class="fas fa-plus-circle mr-1"></i> Create your first category
                        </a>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="p-4 border-t border-slate-200 dark:border-slate-700">
                {{-- {{ $categories->links() }} --}}
            </div>
        </div>
    </div>

    <!-- Link to FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

            // View switching functionality
            const tableView = document.getElementById('tableView');
            const gridView = document.getElementById('gridView');
            const gridViewBtn = document.getElementById('gridViewBtn');
            const listViewBtn = document.getElementById('listViewBtn');

            gridViewBtn.addEventListener('click', function() {
                tableView.classList.add('hidden');
                gridView.classList.remove('hidden');
                gridViewBtn.classList.remove('text-slate-400', 'dark:text-slate-500');
                gridViewBtn.classList.add('text-blue-600', 'dark:text-blue-400');
                listViewBtn.classList.remove('text-blue-600', 'dark:text-blue-400');
                listViewBtn.classList.add('text-slate-400', 'dark:text-slate-500');
                localStorage.setItem('categoryView', 'grid');
            });

            listViewBtn.addEventListener('click', function() {
                gridView.classList.add('hidden');
                tableView.classList.remove('hidden');
                listViewBtn.classList.remove('text-slate-400', 'dark:text-slate-500');
                listViewBtn.classList.add('text-blue-600', 'dark:text-blue-400');
                gridViewBtn.classList.remove('text-blue-600', 'dark:text-blue-400');
                gridViewBtn.classList.add('text-slate-400', 'dark:text-slate-500');
                localStorage.setItem('categoryView', 'list');
            });

            // Load saved view preference
            const savedView = localStorage.getItem('categoryView');
            if (savedView === 'grid') {
                gridViewBtn.click();
            }

            // Search functionality
            const searchInput = document.getElementById('categorySearch');
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll('#tableView tbody tr');
                const cards = document.querySelectorAll('#gridView > div');
                
                // Filter table rows
                rows.forEach(row => {
                    if (!row.querySelector('td[colspan]')) { // Skip empty state row
                        const name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                        const description = row.querySelector('td:nth-child(3)') ? 
                            row.querySelector('td:nth-child(3)').textContent.toLowerCase() : '';
                        
                        if (name.includes(searchTerm) || description.includes(searchTerm)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    }
                });
                
                // Filter grid cards
                cards.forEach(card => {
                    if (!card.classList.contains('col-span-full')) { // Skip empty state card
                        const name = card.querySelector('h4').textContent.toLowerCase();
                        const description = card.querySelector('p').textContent.toLowerCase();
                        
                        if (name.includes(searchTerm) || description.includes(searchTerm)) {
                            card.style.display = '';
                        } else {
                            card.style.display = 'none';
                        }
                    }
                });
            });
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
            
            // Toast content with FontAwesome icon
            toast.innerHTML = `
                <div class="flex items-center">
                    <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} mr-3"></i>
                    <span>${message}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="ml-4">
                    <i class="fas fa-times"></i>
                </button>
            `;

            // Add to toaster
            toaster.appendChild(toast);

            // Animation effects
            setTimeout(() => {
                toast.classList.add('scale-105');
                setTimeout(() => toast.classList.remove('scale-105'), 150);
            }, 50);

            // Auto-dismiss after 5 seconds
            setTimeout(() => {
                toast.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => toast.remove(), 300);
            }, 5000);
        }
    </script>
</x-admin-layout>