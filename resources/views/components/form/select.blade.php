@props(['id', 'name', 'label', 'options', 'selected' => null, 'required' => false, 'placeholder' => 'Select an option'])
<label for="{{ $id }}" class="block text-sm font-medium text-gray-300 mb-2">{{ $label }}</label>
<div class="relative">
    <select id="{{ $id }}" 
            name="{{ $name }}"
            {{ $required ? 'required' : '' }}
            class="select2-single w-full rounded-lg border border-slate-700 bg-slate-900 px-4 py-3 text-gray-300 focus:border-blue-500 focus:ring-blue-500">
        <option value="">{{ $placeholder }}</option>
        @foreach($options as $option)
            <option value="{{ $option->id }}" 
                    {{ $selected == $option->id ? 'selected' : '' }}>
                {{ $option->name }}
            </option>
        @endforeach
    </select>
</div>
@error($name)
    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
@enderror