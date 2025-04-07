<x-admin-layout>
    <!-- Toaster Notification System -->
    <div id="toaster" class="fixed top-4 right-4 z-50 space-y-2"></div>
    
    <div class="mt-6 sm:mt-8 container mx-auto px-4">
        <div class="bg-slate-800 rounded-xl border border-slate-700 shadow-xl">
            <div class="p-5 sm:p-7 space-y-6">
                <!-- Header Section with Search -->
                <div class="flex justify-between items-center flex-col md:flex-row gap-4">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-users mr-2 text-blue-400"></i>
                        Users Management
                    </h3>
                    
                    <!-- Search Input with Icon -->
                    <div class="w-full md:w-64 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input 
                            type="text" 
                            id="searchInput"
                            class="w-full pl-10 pr-4 py-2 bg-slate-700 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-300 placeholder-gray-500"
                            placeholder="Search users..."
                        >
                    </div>
                </div>

                <!-- Table Section -->
                <div class="overflow-x-auto rounded-lg border border-slate-700">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-slate-700 text-left">
                                <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-blue-300 uppercase tracking-wider hidden lg:table-cell">ID</th>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-blue-300 uppercase tracking-wider">Name</th>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-blue-300 uppercase tracking-wider hidden lg:table-cell">Email</th>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-blue-300 uppercase tracking-wider hidden xl:table-cell">Joined Date</th>
                                <th class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-blue-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="usersTableBody" class="divide-y divide-slate-700">
                            @forelse($users as $user)
                            <tr class="hover:bg-slate-700/50 transition-colors" data-user-name="{{ strtolower($user->name) }}" data-user-email="{{ strtolower($user->email) }}">
                                <td class="px-4 sm:px-6 py-3 sm:py-4 text-gray-300 hidden lg:table-cell">
                                    <span class="bg-slate-700 px-2 py-1 rounded text-xs">{{ $user->id }}</span>
                                </td>
                                <td class="px-4 sm:px-6 py-3 sm:py-4 font-medium">
                                    <a href="{{ route('profile.user', $user) }}" 
                                       class="text-yellow-400 hover:text-blue-400 transition-colors flex items-center">
                                        <i class="fas fa-user-circle mr-2 text-gray-400"></i>
                                        {{ $user->name }}
                                    </a>
                                </td>
                                <td class="px-4 sm:px-6 py-3 sm:py-4 text-gray-300 hidden lg:table-cell">
                                    <div class="flex items-center">
                                        <i class="fas fa-envelope mr-2 text-gray-500"></i>
                                        {{ $user->email }}
                                    </div>
                                </td>
                                <td class="px-4 sm:px-6 py-3 sm:py-4 text-gray-300 hidden xl:table-cell">
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar-alt mr-2 text-gray-500"></i>
                                        {{ $user->created_at->format('M d, Y') }}
                                    </div>
                                </td>
                                <td class="px-4 sm:px-6 py-3 sm:py-4">
                                    <div class="flex space-x-3">
                                        <a 
                                            href="{{ route('users.edit', $user) }}"
                                            class="text-blue-400 hover:text-blue-300 text-xs flex items-center space-x-1 bg-slate-700 px-3 py-1.5 rounded-lg hover:bg-slate-600 transition-colors"
                                        >
                                            <i class="fas fa-edit"></i>
                                            <span class="hidden lg:block ml-1">Edit</span>
                                        </a>
                                        <button 
                                            onclick="userManager.openDeleteModal('{{ route('users.destroy', $user) }}')"
                                            class="text-red-400 hover:text-red-300 text-xs flex items-center space-x-1 bg-slate-700 px-3 py-1.5 rounded-lg hover:bg-slate-600 transition-colors"
                                        >
                                            <i class="fas fa-trash-alt"></i>
                                            <span class="hidden lg:block ml-1">Delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-6 text-slate-400">
                                    <i class="fas fa-users-slash text-4xl mb-2 block"></i>
                                    No users available
                                </td>
                            </tr>
                            @endforelse
                            <tr id="noResultsRow" class="hidden">
                                <td colspan="5" class="text-center py-6 text-slate-400">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-search text-4xl mb-2"></i>
                                        <span>No users found matching your search</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="p-4 bg-slate-800">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div 
            id="deleteModal"
            class="fixed inset-0 z-50 hidden modal-overlay flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm"
        >
            <div class="bg-slate-800 rounded-xl p-6 max-w-sm mx-8 md:mx-auto border border-slate-700 shadow-2xl transform transition-all scale-95 opacity-0 modal-content">
                <div class="flex items-center mb-4 text-red-500">
                    <i class="fas fa-exclamation-triangle text-2xl mr-2"></i>
                    <h2 class="text-xl font-bold text-white">Confirm Deletion</h2>
                </div>
                
                <p class="mb-6 text-gray-300">Are you sure you want to delete this user? This action cannot be undone.</p>
                
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    
                    <div class="flex justify-end space-x-3">
                        <button 
                            type="button"
                            class="modal-close px-4 py-2 bg-slate-700 text-gray-300 rounded-lg hover:bg-slate-600 transition-colors flex items-center"
                        >
                            <i class="fas fa-times mr-1"></i>
                            Cancel
                        </button>
                        <button 
                            type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors flex items-center"
                        >
                            <i class="fas fa-trash-alt mr-1"></i>
                            Delete
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Include Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

    <script>
        class UserManager {
            constructor() {
                this.deleteModal = document.getElementById('deleteModal');
                this.modalContent = document.querySelector('.modal-content');
                this.deleteForm = document.getElementById('deleteForm');
                this.searchInput = document.getElementById('searchInput');
                this.noResultsRow = document.getElementById('noResultsRow');
                
                this.init();
                this.initSearch();
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

            initSearch() {
                this.searchInput.addEventListener('input', (e) => {
                    const searchTerm = e.target.value.toLowerCase();
                    let hasVisibleRows = false;

                    // Get all rows except the header and no results row
                    const rows = document.querySelectorAll('#usersTableBody tr:not(#noResultsRow)');

                    rows.forEach(row => {
                        if (!row.dataset.userName) return; // Skip rows without data attributes
                        
                        const name = row.dataset.userName;
                        const email = row.dataset.userEmail;
                        
                        if (name.includes(searchTerm) || email.includes(searchTerm)) {
                            row.classList.remove('hidden');
                            hasVisibleRows = true;
                        } else {
                            row.classList.add('hidden');
                        }
                    });

                    // Show/hide no results message
                    this.noResultsRow.classList.toggle('hidden', hasVisibleRows);
                });
            }

            openDeleteModal(url) {
                this.deleteModal.classList.remove('hidden');
                this.deleteForm.action = url;
                
                // Animate modal appearance
                setTimeout(() => {
                    this.modalContent.classList.remove('scale-95', 'opacity-0');
                    this.modalContent.classList.add('scale-100', 'opacity-100');
                }, 10);
                
                // Add toast notification
                this.showToast('Warning: You are about to delete a user', 'warning');
            }

            closeModals() {
                // Animate modal disappearance
                this.modalContent.classList.remove('scale-100', 'opacity-100');
                this.modalContent.classList.add('scale-95', 'opacity-0');
                
                setTimeout(() => {
                    this.deleteModal.classList.add('hidden');
                }, 200);
            }
            
         
        }

        // Initialize user manager when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            window.userManager = new UserManager();
        });
    </script>
</x-admin-layout>