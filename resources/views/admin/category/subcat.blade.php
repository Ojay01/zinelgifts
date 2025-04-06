<!-- resources/views/admin/category/subcat.blade.php -->
<x-admin-layout>
    <div id="toaster" class="fixed top-4 right-4 z-50 space-y-2"></div>
   <!-- Breadcrumb -->
   <nav class="mb-4 flex items-center text-gray-400 text-sm">
    <a href="{{ route('dashboard') }}" class="hover:text-white transition-colors">
        <i class="fas fa-home"></i>
    </a>
    <span class="mx-2">/</span>
    <a href="{{ route('categories.index') }}" class="hover:text-white transition-colors">
        Categories
    </a>
    <span class="mx-2">/</span>
    <span class="text-white">{{ $category->name }}</span>
</nav>
    <div class="mt-4 sm:mt-6 container mx-auto px-4">
        <div class="bg-slate-800 rounded-lg border border-slate-700 shadow-lg">
            <div class="p-4 sm:p-6 flex justify-between items-center flex-col md:flex-row">
                <div class="flex items-center space-x-2 mb-3 md:mb-0">
                    <a href="{{ route('categories.index') }}" class="text-slate-400 hover:text-slate-200 transition-colors">
                        <i class="fas fa-arrow-left text-lg"></i>
                    </a>
                    <h3 class="text-base sm:text-lg font-semibold">
                        Subcategories for <span class="text-yellow-500 text-lg"> {{ $category->name }} </span>
                    </h3>
                </div>
                
                <button 
                    onclick="modalManager.openSubcategoryModal('add')"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-xs sm:text-sm flex items-center space-x-1 w-full md:w-auto justify-center"
                >
                    <i class="fas fa-plus"></i>
                    <span class="ml-1">Add Subcategory</span>
                </button>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-t border-slate-700 bg-slate-800/50">
                            <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Name</th>
                            <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700">
                        @forelse($subcategories as $subcategory)
                        <tr class="hover:bg-slate-700/50 transition-colors">
                            <td class="px-3 sm:px-6 py-2 sm:py-4 whitespace-nowrap">
                                {{ $subcategory->name }}
                            </td>
                          
                            <td class="px-3 sm:px-6 py-2 sm:py-4 whitespace-nowrap">
                                <div class="flex space-x-2">
                                    <button 
                                        onclick="modalManager.openSubcategoryModal('edit', {{ json_encode($subcategory) }})"
                                        class="text-blue-400 hover:text-blue-300 text-xs flex items-center space-x-1"
                                    >
                                        <i class="fas fa-edit"></i>
                                        <span class="ml-1">Edit</span>
                                    </button>
                                    <button 
                                        onclick="modalManager.openConfirmModal('{{ route('subcategories.destroy', [$category, $subcategory]) }}')"
                                        class="text-red-400 hover:text-red-300 text-xs flex items-center space-x-1"
                                    >
                                        <i class="fas fa-trash-alt"></i>
                                        <span class="ml-1">Delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-slate-400">
                                No subcategories found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="p-4">
                    {{ $subcategories->links() }}
                </div>
            </div>
        </div>

        <!-- Confirmation Modal -->
        <div 
            id="confirmModal"
            class="fixed inset-0 z-50 hidden modal-overlay flex items-center justify-center bg-black bg-opacity-50"
        >
            <div class="bg-red-300 rounded-lg p-6 max-w-sm mx-auto w-11/12 sm:w-auto">
                <h2 class="text-xl font-bold mb-4 text-black">Confirm Deletion</h2>
                <p class="mb-4 text-black">Are you sure you want to delete this subcategory? This action cannot be undone.</p>
                
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
                            onclick="modalManager.performDelete()"
                            class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600"
                        >
                            Delete
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Subcategory Modal -->
        <div 
            id="subcategoryModal"
            class="fixed inset-0 z-50 hidden modal-overlay flex items-center justify-center bg-black bg-opacity-50"
        >
            <div class="bg-slate-800 rounded-lg p-6 max-w-sm w-11/12 sm:w-full mx-auto">
                <h2 id="modalTitle" class="text-xl font-bold mb-4 text-gray-300"></h2>
                <form 
                    id="subcategoryForm"
                    data-store-url="{{ route('subcategories.store', $category) }}"
                    data-update-url="{{ route('subcategories.update', [$category, '__ID__']) }}"
                    method="POST"
                >
                    @csrf
                    <input type="hidden" name="_method" id="methodInput" value="POST">

                    <div class="mb-4">
                        <label for="nameInput" class="block text-sm font-medium text-gray-300 mb-2">Name</label>
                        <input 
                            type="text" 
                            name="name" 
                            id="nameInput" 
                            required 
                            class="w-full px-3 py-2 border bg-slate-800/50 border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-300"
                        >
                    </div>
                    
                    <div class="flex justify-end space-x-2">
                        <button 
                            type="button"
                            class="modal-close px-4 py-2 bg-slate-700 text-gray-300 rounded-lg hover:bg-slate-600"
                        >
                            Cancel
                        </button>
                        <button 
                            id="submitBtn"
                            type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600"
                        >
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Include Font Awesome in your layout or add it here -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>

    <script>
   class ModalManager {
    constructor() {
        this.subcategoryModal = document.getElementById('subcategoryModal');
        this.confirmModal = document.getElementById('confirmModal');
        this.subcategoryForm = document.getElementById('subcategoryForm');
        this.deleteForm = document.getElementById('deleteForm');
        this.modalTitle = document.getElementById('modalTitle');
        this.nameInput = document.getElementById('nameInput');
        this.submitBtn = document.getElementById('submitBtn');
        this.methodInput = document.getElementById('methodInput');
        
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

    openSubcategoryModal(mode, data = null) {
        this.subcategoryModal.classList.remove('hidden');
        const storeUrl = this.subcategoryForm.dataset.storeUrl;
        const updateUrl = this.subcategoryForm.dataset.updateUrl;
        
        if (mode === 'add') {
            this.modalTitle.textContent = 'Add Subcategory';
            this.submitBtn.textContent = 'Add';
            this.subcategoryForm.action = storeUrl;
            this.methodInput.value = 'POST';
            this.nameInput.value = '';
        } else {
            this.modalTitle.textContent = 'Edit Subcategory';
            this.submitBtn.textContent = 'Update';
            this.subcategoryForm.action = updateUrl.replace('__ID__', data.id);
            this.methodInput.value = 'PUT';
            this.nameInput.value = data.name;
        }
    }

    openConfirmModal(url) {
        this.confirmModal.classList.remove('hidden');
        this.deleteForm.action = url;
    }

    performDelete() {
        this.deleteForm.submit();
        this.closeModals();
    }

    closeModals() {
        this.subcategoryModal.classList.add('hidden');
        this.confirmModal.classList.add('hidden');
    }
}

// Initialize modal manager when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    window.modalManager = new ModalManager();
});
    </script>
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
                    <i class="fas fa-times"></i>
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