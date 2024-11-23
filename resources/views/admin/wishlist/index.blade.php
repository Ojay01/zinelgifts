<!-- resources/views/admin/wishlists/index.blade.php -->
<x-admin-layout>
    <div id="toaster" class="fixed top-4 right-4 z-50 space-y-2"></div>
    <div class="mt-4 sm:mt-6 container mx-auto px-4">
        <div class="bg-slate-800 rounded-lg border border-slate-700 shadow-lg">
            <div class="p-4 sm:p-6 flex justify-between items-center flex-col md:flex-row">
                <h3 class="text-lg font-semibold text-gray-300">
                    Wishlist Management
                </h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-t border-slate-700 bg-slate-800/50">
                            <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider hidden lg:table-cell">ID</th>
                            <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">User</th>
                            <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Product</th>
                            <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider hidden lg:table-cell">Added Date</th>
                            <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs font-medium text-slate-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700">
                        @forelse($wishlists as $wishlist)
                        <tr class="hover:bg-slate-700/50 transition-colors">
                            <td class="px-3 sm:px-6 py-2 sm:py-4 hidden lg:table-cell">
                                {{ $wishlist->id }}
                            </td>
                            <td class="px-3 sm:px-6 py-2 sm:py-4 text-yellow-500">
                                <a href="{{ route('profile.user', $wishlist->user->id) }}" 
                                   class="hover:text-blue-400 transition-colors">
                                    {{ $wishlist->user->name }}
                                </a>
                            </td>
                            <td class="px-3 sm:px-6 py-2 sm:py-4 text-gray-300">
                                {{ $wishlist->product->name }}
                            </td>
                            <td class="px-3 sm:px-6 py-2 sm:py-4 text-gray-300 hidden lg:table-cell">
                                {{ $wishlist->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-3 sm:px-6 py-2 sm:py-4">
                                <div class="flex space-x-2">
                                    <button 
                                        onclick="wishlistManager.openConfirmModal('{{ route('wishlists.destroy', $wishlist->id) }}')"
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
                            <td colspan="5" class="text-center py-4 text-slate-400">
                                No Wishlist items found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="p-4">
                    {{ $wishlists->links() }}
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
                <p class="mb-4 text-gray-400">Are you sure you want to remove this item from the wishlist? This action cannot be undone.</p>
                
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
                            onclick="wishlistManager.performDelete()"
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
    class WishlistManager {
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

    // Initialize wishlist manager when DOM is loaded
    document.addEventListener('DOMContentLoaded', () => {
        window.wishlistManager = new WishlistManager();
    });
    </script>
</x-admin-layout>