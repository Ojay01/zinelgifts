@props(['sizes', 'colors', 'qualities', 'types', 'product' => null])
<div id="attributes-tab" class="tab-content hidden">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Sizes -->
        <div class="bg-slate-900 rounded-lg p-5 border border-slate-700">
            <h4 class="text-md font-medium text-blue-400 mb-4 flex items-center">
                <i class="fas fa-expand-arrows-alt mr-2"></i>
                Sizes
            </h4>
            <select id="sizes" name="attributes[sizes][]" multiple class="select2-multiple w-full">
                @foreach($sizes as $size)
                    <option value="{{ $size->id }}" {{ in_array($size->id, old('attributes.sizes', $product?->attributes?->sizes ?? [])) ? 'selected' : '' }}>
                        {{ $size->name }}
                    </option>
                @endforeach
            </select>
            @error('attributes.sizes')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Colors -->
        <div class="bg-slate-900 rounded-lg p-5 border border-slate-700">
            <h4 class="text-md font-medium text-blue-400 mb-4 flex items-center">
                <i class="fas fa-palette mr-2"></i>
                Colors
            </h4>
            <select id="colors" name="attributes[colors][]" multiple class="select2-multiple w-full">
                @foreach($colors as $color)
                    <option value="{{ $color->id }}" {{ in_array($color->id, old('attributes.colors', $product?->attributes?->colors ?? [])) ? 'selected' : '' }}>
                        {{ $color->name }}
                    </option>
                @endforeach
            </select>
            @error('attributes.colors')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Quality -->
        <div class="bg-slate-900 rounded-lg p-5 border border-slate-700">
            <h4 class="text-md font-medium text-blue-400 mb-4 flex items-center">
                <i class="fas fa-star mr-2"></i>
                Quality
            </h4>
            <select id="qualities" name="attributes[qualities][]" multiple class="select2-multiple w-full">
                @foreach($qualities as $quality)
                    <option value="{{ $quality->id }}" {{ in_array($quality->id, old('attributes.qualities', $product?->attributes?->qualities ?? [])) ? 'selected' : '' }}>
                        {{ $quality->name }}
                    </option>
                @endforeach
            </select>
            @error('attributes.qualities')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Types -->
        <div class="bg-slate-900 rounded-lg p-5 border border-slate-700">
            <h4 class="text-md font-medium text-blue-400 mb-4 flex items-center">
                <i class="fas fa-tag mr-2"></i>
                Types
            </h4>
            <select id="types" name="attributes[types][]" multiple class="select2-multiple w-full">
                @foreach($types as $type)
                    <option value="{{ $type->id }}" {{ in_array($type->id, old('attributes.types', $product?->attributes?->types ?? [])) ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
            @error('attributes.types')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>