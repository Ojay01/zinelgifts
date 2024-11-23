<!-- resources/views/admin/users/index.blade.php -->
<x-admin-layout>
    <div id="toaster" class="fixed top-4 right-4 z-50 space-y-2"></div>
    <div class="mt-4 sm:mt-6 container mx-auto px-4">
        <div class="bg-slate-800 rounded-lg border border-slate-700 shadow-lg">
            <div class="p-4 sm:p-6 space-y-4">
                <div class="flex justify-between items-center flex-col md:flex-row gap-4">
                    <h3 class="text-lg font-semibold text-gray-300">
                        Users Management
                    </h3>
                    
                    <!-- Search Input -->
                    <div class="w-full md:w-64">
                        <input 
                            type="text" 
                            id="searchInput"
                            class="w-full px-3 py-2 bg-slate-800/50 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-300"
                            placeholder="Search users..."
                        >
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-t border-slate-700 bg-slate-800/50">
                                <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider hidden lg:table-cell">ID</th>
                                <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Name</th>
                                <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider hidden lg:table-cell">Email</th>
                                <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider hidden xl:table-cell">Joined Date</th>
                                <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="usersTableBody" class="divide-y divide-slate-700">
                            @forelse($users as $user)
                            <tr class="hover:bg-slate-700/50 transition-colors" data-user-name="{{ strtolower($user->name) }}" data-user-email="{{ strtolower($user->email) }}">
                                <td class="px-3 sm:px-6 py-2 sm:py-4 text-gray-300 hidden lg:table-cell">
                                    {{ $user->id }}
                                </td>
                                <td class="px-3 sm:px-6 py-2 sm:py-4 text-yellow-500">
                                    <a href="{{ route('profile.user', $user) }}" 
                                       class="hover:text-blue-400 transition-colors">
                                        {{ $user->name }}
                                    </a>
                                </td>
                                <td class="px-3 sm:px-6 py-2 sm:py-4 text-gray-300 hidden lg:table-cell">
                                    {{ $user->email }}
                                </td>
                                <td class="px-3 sm:px-6 py-2 sm:py-4 text-gray-300 hidden xl:table-cell">
                                    {{ $user->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-3 sm:px-6 py-2 sm:py-4">
                                    <div class="flex space-x-2">
                                        <a 
                                            href="{{ route('users.edit', $user) }}"
                                            class="text-blue-400 hover:text-blue-300 text-xs flex items-center space-x-1"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            <span class="hidden lg:block">Edit</span>
                                        </a>
                                        <button 
                                            onclick="userManager.openDeleteModal('{{ route('users.destroy', $user) }}')"
                                            class="text-red-400 hover:text-red-300 text-xs flex items-center space-x-1"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            <span class="hidden lg:block">Delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr id="noResultsRow" class="hidden">
                                <td colspan="5" class="text-center py-4 text-slate-400">
                                    No users found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="p-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div 
            id="deleteModal"
            class="fixed inset-0 z-50 hidden modal-overlay flex items-center justify-center bg-black bg-opacity-50"
        >
            <div class="bg-slate-800 rounded-lg p-6 max-w-sm mx-8 md:mx-auto">
                <h2 class="text-xl font-bold mb-4 text-gray-300">Confirm Deletion</h2>
                <p class="mb-4 text-gray-400">Are you sure you want to delete this user? This action cannot be undone.</p>
                
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
                            type="submit"
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
        class UserManager {
            constructor() {
                this.deleteModal = document.getElementById('deleteModal');
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
            }

            closeModals() {
                this.deleteModal.classList.add('hidden');
            }
        }

        // Initialize user manager when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            window.userManager = new UserManager();
        });
    </script>
</x-admin-layout>