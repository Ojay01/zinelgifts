<div id="pricing-tab" class="tab-content hidden">
    <div class="bg-slate-900 rounded-lg p-5 border border-slate-700 mb-6">
        <h4 class="text-lg font-medium text-white mb-4">Pricing Options</h4>
        
        <!-- Variable Pricing Toggle with improved styling -->
        <div class="flex items-center mb-4">
            <div class="relative inline-block w-12 mr-3 align-middle select-none">
                <input type="checkbox" 
                       id="variable" 
                       name="variable" 
                       value="1"
                       {{ old('variable') ? 'checked' : '' }}
                       class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 border-gray-300 appearance-none cursor-pointer transition-transform duration-200 ease-in-out">
                <label for="variable" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-600 cursor-pointer"></label>
            </div>
            <label for="variable" class="text-md font-medium text-gray-300">Variable Pricing</label>
        </div>
        <p class="text-sm text-gray-400 mb-6 ml-1">Enable if price varies by size, quality, or both</p>
        
        <!-- Standard Price -->
        <div id="standard-price-container" class="mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-300 mb-2">Base Price (₣)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <span class="text-gray-400">₣</span>
                        </div>
                        <input type="number" 
                               id="price" 
                               name="price" 
                               value="{{ old('price', 0) }}"
                               step="0.01"
                               required
                               class="w-full rounded-lg border border-slate-700 bg-slate-900 pl-8 pr-4 py-3 text-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    @error('price')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="discount" class="block text-sm font-medium text-gray-300 mb-2">Discount Percentage</label>
                    <div class="relative">
                        <input type="number" 
                               id="discount" 
                               name="discount" 
                               value="{{ old('discount', 0) }}"
                               min="0"
                               max="100"
                               class="w-full rounded-lg border border-slate-700 bg-slate-900 pl-4 pr-10 py-3 text-gray-300 focus:border-blue-500 focus:ring-blue-500">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                            <span class="text-gray-400">%</span>
                        </div>
                    </div>
                    @error('discount')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        
        <!-- Pricing Type Selection (Hidden initially, shown when variable pricing is enabled) -->
        <div id="pricing-type-container" class="hidden mb-5">
            <p class="text-sm font-medium text-gray-300 mb-3">Price varies by:</p>
            <div class="flex space-x-4">
                <div class="flex items-center">
                    <input type="radio" 
                           id="pricing_type_size" 
                           name="pricing_type" 
                           value="size"
                           checked
                           class="w-4 h-4 text-blue-600 focus:ring-blue-500 border-gray-600 bg-gray-800">
                    <label for="pricing_type_size" class="ml-2 text-sm font-medium text-gray-300">Size only</label>
                </div>
                <div class="flex items-center">
                    <input type="radio" 
                           id="pricing_type_quality" 
                           name="pricing_type" 
                           value="quality"
                           class="w-4 h-4 text-blue-600 focus:ring-blue-500 border-gray-600 bg-gray-800">
                    <label for="pricing_type_quality" class="ml-2 text-sm font-medium text-gray-300">Quality only</label>
                </div>
                <div class="flex items-center">
                    <input type="radio" 
                           id="pricing_type_matrix" 
                           name="pricing_type" 
                           value="matrix"
                           class="w-4 h-4 text-blue-600 focus:ring-blue-500 border-gray-600 bg-gray-800">
                    <label for="pricing_type_matrix" class="ml-2 text-sm font-medium text-gray-300">Both (matrix pricing)</label>
                </div>
            </div>
        </div>
        
        <!-- Size-based Pricing Container -->
        <div id="size-pricing-container" class="hidden mb-6">
            <h5 class="text-md font-medium text-gray-300 mb-3">Size Pricing</h5>
            <div id="size-variants">
                <!-- Size variant fields will be generated dynamically -->
            </div>
        </div>
        
        <!-- Quality-based Pricing Container -->
        <div id="quality-pricing-container" class="hidden mb-6">
            <h5 class="text-md font-medium text-gray-300 mb-3">Quality Pricing</h5>
            <div id="quality-variants">
                <!-- Quality variant fields will be generated dynamically -->
            </div>
        </div>
        
        <!-- Matrix Pricing Container -->
        <div id="matrix-pricing-container" class="hidden mb-6">
            <h5 class="text-md font-medium text-gray-300 mb-3">Matrix Pricing (Size × Quality)</h5>
            <div id="matrix-variants">
                <!-- Matrix variant fields will be generated dynamically -->
            </div>
        </div>
    </div>
</div>