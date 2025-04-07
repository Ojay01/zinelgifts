@props(['id', 'name', 'options', 'selected' => [], 'placeholder' => 'Select options'])
<select id="{{ $id }}" 
        name="{{ $name }}" 
        multiple
        class="select2-multiple w-full">
    @foreach($options as $option)
        <option value="{{ $option->id }}"
                {{ in_array($option->id, is_array($selected) ? $selected : []) ? 'selected' : '' }}>
            {{ $option->name }}
        </option>
    @endforeach
</select>
@if(str_contains($name, '[') && str_contains($name, ']'))
    @php
        $errorName = str_replace(['[', ']'], ['.', ''], $name);
    @endphp
    @error($errorName)
        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
    @enderror
@else
    @error($name)
        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
    @enderror
@endif