@props(['categories'])

<div id="basics-tab" class="tab-content">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Left column -->
        <div>
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Product Name</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="{{ old('name') }}"
                       required
                       placeholder="Enter product name"
                       class="w-full rounded-lg border border-slate-700 bg-slate-900 px-4 py-3 text-gray-300 focus:border-blue-500 focus:ring-blue-500">
                @error('name')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <x-form.select 
                    id="category_id"
                    name="category_id"
                    label="Category"
                    :options="$categories"
                    :selected="old('category_id')"
                    required="true"
                    placeholder="Select Category"
                />
            </div>
            
            <div class="mb-6">
                <x-form.select 
                    id="subcategory_id"
                    name="subcategory_id"
                    label="Subcategory"
                    :options="[]"
                    :selected="old('subcategory_id')"
                    placeholder="Select Subcategory"
                />
            </div>
        </div>
        
        <!-- Right column with image upload -->
        <div class="flex flex-col items-center justify-center">
            <x-form.image-upload 
                name="image"
                label="Product Image"
                :value="old('image')"
                required="true"
            />
        </div>
    </div>
</div>
