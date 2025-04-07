<x-admin-layout>
    <div class="mt-4 sm:mt-6 container mx-auto px-4">
        <div id="toaster" class="fixed top-4 right-4 z-50 space-y-2"></div>
        <!-- Header with Search and Filter -->

        <x-admin.products.header :categories="$categories" />
        <x-admin.products.stats 
        :totalProducts="$totalProducts" 
        :discountedProducts="$discountedProducts"
        :categoriesCount="$categoriesCount" 
        :featuredProducts="$featuredProducts" 
    />
    

        <!-- Product Table Card -->
        <div class="bg-slate-800 rounded-lg border border-slate-700 shadow-lg">
            <div class="p-4 sm:p-6 flex justify-between items-center flex-col sm:flex-row gap-4">
                <h3 class="text-lg font-semibold text-gray-300">
                    Product Inventory
                    <span class="ml-2 text-sm text-gray-400">({{ $products->total() }} items)</span>
                </h3>
                <div class="flex items-center gap-2">
                    <button id="toggleView" class="p-2 text-gray-400 hover:text-gray-200 bg-slate-700 rounded-lg">
                        <i class="fas fa-list"></i>
                    </button>
                    <a href="#" class="p-2 text-gray-400 hover:text-gray-200 bg-slate-700 rounded-lg flex items-center">
                        <i class="fas fa-file-export mr-2"></i>
                        <span class="hidden sm:inline">Export</span>
                    </a>
                </div>
            </div>

            <div id="tableView" class="overflow-x-auto">
                <x-admin.products.table :products="$products" />
            </div>
            
            <div id="gridView" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 p-4 hidden">
                @forelse($products as $product)
                     <x-admin.products.grid :product="$product" />
                @empty
                <div class="col-span-1 sm:col-span-2 lg:col-span-3 xl:col-span-4">
                     <x-admin.products.empty />
                </div>
                @endforelse
            </div>
            
            <div class="p-4">
                {{ $products->links() }}
            </div>
        </div>

        <!-- Confirm Delete Modal -->
        <x-admin.products.delete />
    </div>

    <script>
    class ProductManager {
        constructor() {
            this.confirmModal = document.getElementById('confirmModal');
            this.deleteForm = document.getElementById('deleteForm');
            this.tableView = document.getElementById('tableView');
            this.gridView = document.getElementById('gridView');
            this.toggleViewBtn = document.getElementById('toggleView');
            
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
            
            // Search functionality
            const searchInput = document.getElementById('productSearch');
            if (searchInput) {
                searchInput.addEventListener('input', this.debounce(() => {
                    this.handleSearch(searchInput.value);
                }, 300));
            }
            
            // Category filter
            const categoryFilter = document.getElementById('categoryFilter');
            if (categoryFilter) {
                categoryFilter.addEventListener('change', () => {
                    window.location.href = `{{ route('products.index') }}?category=${categoryFilter.value}`;
                });
            }
            
            // Toggle view button
            if (this.toggleViewBtn) {
                this.toggleViewBtn.addEventListener('click', () => this.toggleView());
                
                // Initialize view based on stored preference
                const storedViewMode = localStorage.getItem('productViewMode') || 'table';
                if (storedViewMode === 'grid') {
                    this.toggleView();
                }
            }
            
            // Status change handlers
            document.querySelectorAll('.status-change').forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    const form = button.closest('form');
                    form.submit();
                });
            });
        }

        toggleView() {
            const isListView = this.toggleViewBtn.querySelector('i').classList.contains('fa-list');
            
            // Toggle icon
            this.toggleViewBtn.querySelector('i').className = isListView ? 'fas fa-table' : 'fas fa-list';
            
            // Toggle views
            if (isListView) {
                this.tableView.classList.add('hidden');
                this.gridView.classList.remove('hidden');
                localStorage.setItem('productViewMode', 'grid');
            } else {
                this.tableView.classList.remove('hidden');
                this.gridView.classList.add('hidden');
                localStorage.setItem('productViewMode', 'table');
            }
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
        
        handleSearch(query) {
            if (query.length >= 2) {
                window.location.href = `{{ route('products.index') }}?search=${encodeURIComponent(query)}`;
            } else if (query.length === 0) {
                window.location.href = `{{ route('products.index') }}`;
            }
        }
        
        debounce(func, delay) {
            let timeout;
            return function() {
                const context = this;
                const args = arguments;
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(context, args), delay);
            };
        }
    }

    // Initialize product manager when DOM is loaded
    document.addEventListener('DOMContentLoaded', () => {
        window.productManager = new ProductManager();
    });
    </script>
</x-admin-layout>