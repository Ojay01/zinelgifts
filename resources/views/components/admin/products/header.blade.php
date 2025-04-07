<div class="mb-4 sm:mb-6 flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
    <h1 class="text-xl sm:text-2xl font-bold text-gray-200">
        Product Management
    </h1>
    <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
        <div class="relative w-full sm:w-64">
            <input type="text" id="productSearch" name="search"
                   value="{{ request('search') }}"
                   placeholder="Search products..." 
                   class="w-full pl-10 pr-4 py-2 bg-slate-700 border border-slate-600 rounded-lg text-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
        </div>                
        <div class="flex gap-2">
            <select id="categoryFilter" class="bg-slate-700 border border-slate-600 rounded-lg text-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" 
                    {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
            <a href="{{ route('products.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors flex-shrink-0">
                <i class="fas fa-plus mr-2"></i>
                <span class="hidden sm:inline">Add Product</span>
                <span class="sm:hidden">Add</span>
            </a>
        </div>
    </div>
</div>