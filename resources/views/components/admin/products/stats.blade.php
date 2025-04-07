<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="bg-slate-800 rounded-lg border border-slate-700 p-4 flex items-center">
        <div class="p-3 rounded-full bg-blue-500/20 text-blue-400 mr-4">
            <i class="fas fa-box-open text-xl"></i>
        </div>
        <div>
            <p class="text-gray-400 text-sm">Total Products</p>
            <p class="text-xl font-semibold text-gray-200">{{ $totalProducts }}</p>
        </div>
    </div>
    
    <div class="bg-slate-800 rounded-lg border border-slate-700 p-4 flex items-center">
        <div class="p-3 rounded-full bg-green-500/20 text-green-400 mr-4">
            <i class="fas fa-tag text-xl"></i>
        </div>
        <div>
            <p class="text-gray-400 text-sm">With Discount</p>
            <p class="text-xl font-semibold text-gray-200">{{ $discountedProducts }}</p>
        </div>
    </div>
    
    <div class="bg-slate-800 rounded-lg border border-slate-700 p-4 flex items-center">
        <div class="p-3 rounded-full bg-purple-500/20 text-purple-400 mr-4">
            <i class="fas fa-folder text-xl"></i>
        </div>
        <div>
            <p class="text-gray-400 text-sm">Categories</p>
            <p class="text-xl font-semibold text-gray-200">{{ $categoriesCount }}</p>
        </div>
    </div>
    
    <div class="bg-slate-800 rounded-lg border border-slate-700 p-4 flex items-center">
        <div class="p-3 rounded-full bg-amber-500/20 text-amber-400 mr-4">
            <i class="fas fa-star text-xl"></i>
        </div>
        <div>
            <p class="text-gray-400 text-sm">Featured</p>
            <p class="text-xl font-semibold text-gray-200">{{ $featuredProducts }}</p>
        </div>
    </div>
</div>