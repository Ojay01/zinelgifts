@props(['id', 'name', 'options', 'selected' => [], 'placeholder' => 'Select options'])
<select id="{{ $id }}" 
        name="{{ $name }}" 
        multiple
        class="select2-multiple w-full">
    @foreach($options as $option)
        <option value="{{ $option->id }}"
                {{ in_array($option->id, $selected) ? 'selected' : '' }}>
            {{ $option->name }}
        </option>
    @endforeach
</select>
@error($name)
    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
@enderror