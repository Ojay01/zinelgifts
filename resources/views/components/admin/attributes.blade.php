@props(['sizes', 'colors', 'qualities', 'types'])

<div id="attributes-tab" class="tab-content hidden">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Sizes -->
        <div class="bg-slate-900 rounded-lg p-5 border border-slate-700">
            <h4 class="text-md font-medium text-blue-400 mb-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5v-4m0 4h-4m4 0l-5-5" />
                </svg>
                Sizes
            </h4>
            <x-form.multi-select
                id="sizes"
                name="attributes[sizes][]"
                :options="$sizes"
                :selected="old('attributes.sizes', [])"
            />
        </div>
    
        <!-- Colors -->
        <div class="bg-slate-900 rounded-lg p-5 border border-slate-700">
            <h4 class="text-md font-medium text-blue-400 mb-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                </svg>
                Colors
            </h4>
            <x-form.multi-select
                id="colors"
                name="attributes[colors][]"
                :options="$colors"
                :selected="old('attributes.colors', [])"
            />
        </div>
    
        <!-- Quality -->
        <div class="bg-slate-900 rounded-lg p-5 border border-slate-700">
            <h4 class="text-md font-medium text-blue-400 mb-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                </svg>
                Quality
            </h4>
            <x-form.multi-select
                id="qualities"
                name="attributes[qualities][]"
                :options="$qualities"
                :selected="old('attributes.qualities', [])"
            />
        </div>
    
        <!-- Types -->
        <div class="bg-slate-900 rounded-lg p-5 border border-slate-700">
            <h4 class="text-md font-medium text-blue-400 mb-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                </svg>
                Types
            </h4>
            <x-form.multi-select
                id="types"
                name="attributes[types][]"
                :options="$types"
                :selected="old('attributes.types', [])"
            />
        </div>
    </div>
</div>
