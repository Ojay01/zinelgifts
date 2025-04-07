<div 
id="confirmModal"
class="fixed inset-0 z-50 hidden modal-overlay flex items-center justify-center bg-black bg-opacity-50"
>
<div class="bg-slate-800 rounded-lg p-6 max-w-sm mx-8 md:mx-auto">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold text-gray-300">Confirm Deletion</h2>
        <button class="modal-close text-gray-400 hover:text-white">
            <i class="fas fa-times"></i>
        </button>
    </div>
    
    <div class="bg-red-500/10 border border-red-500/20 rounded-lg p-4 mb-4">
        <div class="flex items-start">
            <i class="fas fa-exclamation-triangle text-red-400 mt-0.5 mr-3"></i>
            <p class="text-gray-400">Are you sure you want to delete this product? This action cannot be undone and will remove all associated data.</p>
        </div>
    </div>
    
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
                class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 flex items-center"
            >
                <i class="fas fa-trash-alt mr-2"></i>
                Delete
            </button>
        </div>
    </form>
</div>
</div>