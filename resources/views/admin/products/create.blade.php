<x-admin-layout >
<!-- Toast notification container -->
<div id="toaster" class="fixed top-4 right-4 z-50 space-y-2"></div>
    
<div class="mt-4 sm:mt-6 container mx-auto px-4 mb-8">
    <!-- Header section -->
    <div class="bg-gradient-to-r from-slate-800 to-slate-900 rounded-t-lg border border-slate-700 shadow-lg p-5 flex flex-col sm:flex-row justify-between items-center gap-4">
        <h3 class="text-xl font-bold text-white flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m6 0H6m6 6V6m6 6H6" />
            </svg>
            {{ $title ?? 'Create Product' }}
        </h3>
        <a href="{{ route('products.index') }}" 
           class="inline-flex items-center px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white rounded-lg transition-colors shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Products
        </a>
    </div>

    <!-- Form body with tabs -->
    <div class="bg-slate-800 rounded-b-lg border-x border-b border-slate-700 shadow-lg">
        <!-- Tab navigation -->
        <div class="border-b border-slate-700">
            <nav class="flex overflow-x-auto" aria-label="Form Sections">
                <button type="button" class="tab-button active py-4 px-6 text-blue-400 border-b-2 border-blue-400 font-medium text-sm transition-all duration-200" data-tab="basics">
                    <i class="fa-solid fa-info-circle mr-2"></i>Basic Info
                </button>
                <button type="button" class="tab-button py-4 px-6 text-gray-400 hover:text-gray-300 font-medium text-sm transition-all duration-200" data-tab="attributes">
                    <i class="fa-solid fa-tags mr-2"></i>Attributes
                </button>
                <button type="button" class="tab-button py-4 px-6 text-gray-400 hover:text-gray-300 font-medium text-sm transition-all duration-200" data-tab="pricing">
                    <i class="fa-solid fa-dollar-sign mr-2"></i>Pricing
                </button>
                <button type="button" class="tab-button py-4 px-6 text-gray-400 hover:text-gray-300 font-medium text-sm transition-all duration-200" data-tab="description">
                    <i class="fa-solid fa-align-left mr-2"></i>Description
                </button>
            </nav>
        </div>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="p-5">
            @csrf
            
            <!-- Tab contents -->
            <x-admin.basic-info :categories="$categories" />
            <x-admin.attributes :sizes="$sizes" :colors="$colors" :qualities="$qualities" :types="$types" />
            <x-admin.pricing />
            <x-admin.description />
            <!-- Add this hidden field inside your form -->
<input type="hidden" id="pricing_data" name="pricing_data" value="">
            
            <!-- Form Footer with Submit Button -->
            <div class="mt-8 pt-6 border-t border-slate-700 flex justify-between items-center">
                <div class="flex items-center">
                    <div class="flex flex-col">
                        <div class="text-xs font-medium text-gray-500 uppercase tracking-wider">Required fields</div>
                        <div class="flex items-center text-xs text-gray-400 mt-1">
                            <span class="h-2 w-2 bg-red-500 rounded-full mr-1"></span>
                            <span>Missing</span>
                            <span class="h-2 w-2 bg-green-500 rounded-full ml-3 mr-1"></span>
                            <span>Complete</span>
                        </div>
                    </div>
                </div>
                
                <div class="flex space-x-3">
                    <button type="button" id="prev-tab-btn" class="hidden inline-flex items-center px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white rounded-lg transition-colors shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Previous
                    </button>
                    
                    <button type="button" id="next-tab-btn" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors shadow-md">
                        Next
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                    
                    <button type="submit" id="submit-btn" class="hidden inline-flex items-center px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Create Product
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Scripts -->
<x-admin.scripts />




</x-admin-layout>
