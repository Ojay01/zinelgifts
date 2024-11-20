<!-- resources/views/admin/colors/index.blade.php -->
<x-admin-layout>

    <div id="toaster" class="fixed top-4 right-4 z-50 space-y-2"></div>
    <div class="mt-4 sm:mt-6 container mx-auto px-4">
        <div class="bg-slate-800 rounded-lg border border-slate-700 shadow-lg">
            <div class="p-4 sm:p-6 flex justify-between items-center flex-col md:flex-row">
                <h3 class="text-lg font-semibold text-gray-300">
                    Sizes Management
                </h3>
                
                <button 
                    onclick="colorManager.openColorModal('add')"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-xs sm:text-sm flex items-center space-x-1"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Add Size</span>
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-t border-slate-700 bg-slate-800/50">
                            <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">ID</th>
                            <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Name</th>
                            <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700">
                        @forelse($sizes as $size)
                        <tr class="hover:bg-slate-700/50 transition-colors">
                            <td class="px-3 sm:px-6 py-2 sm:py-4">
                                 {{ $size->id }}
                            </td>
                            <td class="px-3 sm:px-6 py-2 sm:py-4 text-gray-300  hidden md:table-cell">
                                {{ $size->name }}
                            </td>
                         
                            <td class="px-3 sm:px-6 py-2 sm:py-4">
                                <div class="flex space-x-2">
                                    <button 
                                        onclick="colorManager.openColorModal('edit', {{ json_encode($size) }})"
                                        class="text-blue-400 hover:text-blue-300 text-xs flex items-center space-x-1"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        <span class="hidden md:block">Edit</span>
                                    </button>
                                    <button 
                                        onclick="colorManager.openConfirmModal('{{ route('sizes.destroy', $size) }}')"
                                        class="text-red-400 hover:text-red-300 text-xs flex items-center space-x-1"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        <span class="hidden md:block">Delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-slate-400">
                                No Sizes found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="p-4">
                    {{ $sizes->links() }}
                </div>
            </div>
        </div>

        <!-- Color Modal -->
        <div 
            id="colorModal"
            class="fixed inset-0 z-50 hidden modal-overlay flex items-center justify-center bg-black bg-opacity-50"
        >
            <div class="bg-slate-800 rounded-lg p-6 max-w-sm w-full mx-8 md:mx-auto">
                <h2 id="modalTitle" class="text-xl font-bold mb-4 text-gray-300"></h2>
                <form 
                    id="colorForm"
                    data-store-url="{{ route('sizes.store') }}"
                    data-update-url="{{ route('sizes.update', '__ID__') }}"
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
                            class="w-full px-3 py-2 border bg-slate-800/50 border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-300"
                            placeholder="e.g. XXL"
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

        <!-- Confirm Delete Modal -->
        <div 
            id="confirmModal"
            class="fixed inset-0 z-50 hidden modal-overlay flex items-center justify-center bg-black bg-opacity-50"
        >
            <div class="bg-slate-800 rounded-lg p-6 max-w-sm mx-8 md:mx-auto">
                <h2 class="text-xl font-bold mb-4 text-gray-300">Confirm Deletion</h2>
                <p class="mb-4 text-gray-400">Are you sure you want to delete this Size? This action cannot be undone.</p>
                
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
                            onclick="colorManager.performDelete()"
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
    class ColorManager {
        constructor() {
            this.colorModal = document.getElementById('colorModal');
            this.confirmModal = document.getElementById('confirmModal');
            this.colorForm = document.getElementById('colorForm');
            this.deleteForm = document.getElementById('deleteForm');
            this.modalTitle = document.getElementById('modalTitle');
            this.nameInput = document.getElementById('nameInput');
            this.valueInput = document.getElementById('valueInput');
            this.hexInput = document.getElementById('hexInput');
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

        openColorModal(mode, data = null) {
            this.colorModal.classList.remove('hidden');
            const storeUrl = this.colorForm.dataset.storeUrl;
            const updateUrl = this.colorForm.dataset.updateUrl;
            
            if (mode === 'add') {
                this.modalTitle.textContent = 'Add Size';
                this.submitBtn.textContent = 'Add';
                this.colorForm.action = storeUrl;
                this.methodInput.value = 'POST';
                this.nameInput.value = '';
                this.valueInput.value = '#000000';
                this.hexInput.value = '#000000';
            } else {
                this.modalTitle.textContent = 'Edit Size';
                this.submitBtn.textContent = 'Update';
                this.colorForm.action = updateUrl.replace('__ID__', data.id);
                this.methodInput.value = 'PUT';
                this.nameInput.value = data.name;
                this.valueInput.value = data.value;
                this.hexInput.value = data.value;
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
            this.colorModal.classList.add('hidden');
            this.confirmModal.classList.add('hidden');
        }
    }

    // Initialize color manager when DOM is loaded
    document.addEventListener('DOMContentLoaded', () => {
        window.colorManager = new ColorManager();
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