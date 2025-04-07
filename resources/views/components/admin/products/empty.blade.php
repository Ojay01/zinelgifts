<div class="flex flex-col items-center">
    <i class="fas fa-box-open text-4xl mb-3 text-slate-500"></i>
    <p class="text-lg font-medium">No products found</p>
    <p class="text-sm text-slate-500 mt-1">Add your first product to get started</p>
    <a href="{{ route('products.create') }}" 
       class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
        <i class="fas fa-plus mr-2"></i>
        Add New Product
    </a>
</div>