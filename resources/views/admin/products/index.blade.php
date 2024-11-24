<!-- resources/views/admin/products/index.blade.php -->
<x-admin-layout>
    <div id="toaster" class="fixed top-4 right-4 z-50 space-y-2"></div>
    <div class="mt-4 sm:mt-6 container mx-auto px-4">
        <div class="bg-slate-800 rounded-lg border border-slate-700 shadow-lg">
            <div class="p-4 sm:p-6 flex justify-between items-center flex-col sm:flex-row gap-4">
                <h3 class="text-lg font-semibold text-gray-300">
                    Product Management
                </h3>
                <a href="{{ route('products.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add New Product
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-t border-slate-700 bg-slate-800/50">
                            <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider hidden lg:table-cell">ID</th>
                            <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Image</th>
                            <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Name</th>
                            <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider hidden md:table-cell">Price</th>
                            <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider hidden xl:table-cell">Category</th>
                            <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700">
                        @forelse($products as $product)
                        <tr class="hover:bg-slate-700/50 transition-colors">
                            <td class="px-3 sm:px-6 py-2 sm:py-4 hidden lg:table-cell">
                                {{ $product->id }}
                            </td>
                            <td class="px-3 sm:px-6 py-2 sm:py-4 cursor-pointer">
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="h-12 w-12 object-cover rounded-lg">
                            </td>
                            <td class="px-3 sm:px-6 py-2 sm:py-4 text-gray-300 cursor-pointer">
                                <div class="flex items-center gap-2">
                                    <div class="max-w-24  lg:max-w-[200px] truncate" title="{{ $product->name }}">
                                        {{ $product->name }}
                                    </div>
                                    @if($product->discount)
                                        <span class="flex-shrink-0 px-2 py-1 text-xs bg-green-500/20 text-green-400 rounded-full">
                                            {{ $product->discount }}% OFF
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-3 sm:px-6 py-2 sm:py-4 text-gray-300 hidden md:table-cell">
                                ₣{{ number_format($product->price, 2) }}
                            </td>
                            <td class="px-3 sm:px-6 py-2 sm:py-4 text-gray-300 hidden xl:table-cell">
                                {{ $product->category->name }}
                            </td>
                            <td class="px-3 sm:px-6 py-2 sm:py-4">
                                <div class="relative" x-data="{ open: false }">
                                    <button 
                                        @click="open = !open"
                                        class="text-slate-400 hover:text-slate-300"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                        </svg>
                                    </button>
                                    
                                    <div 
                                        x-show="open" 
                                        @click.away="open = false"
                                        class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-slate-700 ring-1 ring-black ring-opacity-5 z-50"
                                    >
                                        <div class="py-1">
                                            <a href="{{ route('products.edit', $product->id) }}" 
                                               class="block px-4 py-2 text-sm text-gray-300 hover:bg-slate-600">
                                                <div class="flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    Edit
                                                </div>
                                            </a>
                                            <button 
                                                onclick="productManager.openConfirmModal('{{ route('products.destroy', $product->id) }}')"
                                                class="block w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-slate-600"
                                            >
                                                <div class="flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Delete
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-slate-400">
                                No products found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="p-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>

        <!-- Confirm Delete Modal -->
        <div 
            id="confirmModal"
            class="fixed inset-0 z-50 hidden modal-overlay flex items-center justify-center bg-black bg-opacity-50"
        >
            <div class="bg-slate-800 rounded-lg p-6 max-w-sm mx-8 md:mx-auto">
                <h2 class="text-xl font-bold mb-4 text-gray-300">Confirm Deletion</h2>
                <p class="mb-4 text-gray-400">Are you sure you want to delete this product? This action cannot be undone.</p>
                
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    
                    <div class="flex justify-end space-x-2">
                        <button 
                            type="button"
                            class="modal-close px-4 py-2 bg-slate-700 text-gray-300 rounded-lg hover:bg-slate-600"
                        >
                            Cancel
                        </button>
                        <button 
                            type="button"
                            onclick="productManager.performDelete()"
                            class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600"
                        >
                            Delete
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    class ProductManager {
        constructor() {
            this.confirmModal = document.getElementById('confirmModal');
            this.deleteForm = document.getElementById('deleteForm');
            
            this.init();
        }

        init() {
            // Add event listeners for close buttons
            document.querySelectorAll('.modal-close').forEach(button => {
                button.addEventListener('click', () => this.closeModals());
            });

            // Close modals when clicking outside
            window.addEventListener('click', (e) => {
                if (e.target.classList.contains('modal-overlay')) {
                    this.closeModals();
                }
            });

            // Close modals on escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    this.closeModals();
                }
            });
        }

        openConfirmModal(url) {
            this.confirmModal.classList.remove('hidden');
            this.deleteForm.action = url;
        }

        performDelete() {
            this.deleteForm.submit();
        }

        closeModals() {
            this.confirmModal.classList.add('hidden');
        }
    }

    // Initialize product manager when DOM is loaded
    document.addEventListener('DOMContentLoaded', () => {
        window.productManager = new ProductManager();
    });
    </script>
</x-admin-layout>