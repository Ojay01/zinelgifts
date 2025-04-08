<div id="description-tab" class="tab-content hidden">
    <div class="bg-slate-900 rounded-lg p-5 border border-slate-700">
        <h4 class="text-md font-medium text-blue-400 mb-4 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
            </svg>
            Product Description
        </h4>
        <textarea id="description" 
                  name="description" 
                  class="hidden">{{ old('description', $product->description ?? "") }}</textarea>
        @error('description')
            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
        @enderror
    </div>
</div>