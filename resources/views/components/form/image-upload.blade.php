@props(['name', 'label', 'value' => null, 'required' => false])
<div class="w-full mb-4">
    <label class="block text-sm font-medium text-gray-300 mb-2">{{ $label }}</label>
    <div class="border-2 border-dashed border-slate-600 rounded-lg p-6 flex flex-col items-center">
        <img id="imagePreview" 
             src="{{ $value ? asset('storage/' . $value) : '/placeholder.jpg' }}"
             alt="Product preview" 
             class="h-40 w-40 object-cover rounded-lg border border-slate-700 mb-4">
             
        <div class="flex items-center justify-center w-full">
            <label for="{{ $name }}" class="flex flex-col items-center justify-center w-full h-32 bg-slate-900 rounded-lg border-2 border-slate-700 cursor-pointer hover:bg-slate-700 transition-all duration-300">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                    <p class="text-sm text-gray-400 mb-1">
                        <span class="font-semibold">{{ $value ? 'Change image' : 'Click to upload' }}</span> or drag and drop
                    </p>
                    <p class="text-xs text-gray-500">SVG, PNG, JPG (MAX. 800x800px)</p>
                </div>
                <input type="file" 
                       id="{{ $name }}" 
                       name="{{ $name }}" 
                       accept="image/*"
                       {{ $required ? 'required' : '' }}
                       class="hidden">
                @if($value)
                    <input type="hidden" name="current_{{ $name }}" value="{{ $value }}">
                @endif
            </label>
        </div>
        @error($name)
            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
        @enderror
    </div>
</div>