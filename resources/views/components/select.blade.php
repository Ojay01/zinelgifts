@props([
    'items' => [],      
    'name' => '',   
    'label' => '',      
    'selected' => null,  
    'displayKey' => 'name', 
    'valueKey' => 'id',    
    'placeholder' => 'Search...',  
    'emptyMessage' => 'No items found'  
])

<div {{ $attributes->merge(['class' => 'mb-6']) }}>
    @if($label)
        <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">{{ $label }}</h3>
    @endif
    
    <div 
        x-data="{ 
            open: false, 
            search: '', 
            selectedValue: '{{ $selected ?? optional($items->first())->{$valueKey} ?? '' }}',
            selectedText: '{{ $selected ? ($items->where($valueKey, $selected)->first()->{$displayKey} ?? '') : (optional($items->first())->{$displayKey} ?? 'Select an option') }}',
            highlight: 0,
            items: {{ Js::from(collect($items)->unique($valueKey)->map(function($item) use ($displayKey, $valueKey) { 
                return [
                    'value' => $item->{$valueKey},
                    'text' => ucfirst($item->{$displayKey})
                ]; 
            })) }}
        }"
        @click.outside="open = false"
        @keydown.escape.window="open = false"
        class="relative"
    >
        <!-- Hidden input field that holds the selected value -->
        <input 
            type="hidden" 
            name="{{ $name }}"
            x-model="selectedValue"
        >
        
        <!-- Dropdown Trigger Button -->
        <button
            @click="open = !open"
            type="button"
            class="relative w-full min-w-[150px] cursor-pointer rounded-lg bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 py-2 pl-3 pr-10 text-left shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-yellow-500 sm:text-sm text-gray-900 dark:text-white"
        >
            <span class="block truncate" x-text="selectedText"></span>
            <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </span>
        </button>
        
        <!-- Dropdown Menu -->
        <div 
            x-show="open"
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="absolute z-10 mt-1 w-full rounded-md bg-white dark:bg-gray-800 shadow-lg max-h-60 overflow-y-auto"
        >
            <!-- Search Input -->
            <div class="sticky top-0 z-20 px-2 py-2 bg-white dark:bg-gray-800 border-b dark:border-gray-700">
                <input
                    x-model="search"
                    @keydown.arrow-down.prevent="highlight = (highlight === items.filter(item => item.text.toLowerCase().includes(search.toLowerCase())).length - 1) ? 0 : highlight + 1"
                    @keydown.arrow-up.prevent="highlight = (highlight === 0) ? items.filter(item => item.text.toLowerCase().includes(search.toLowerCase())).length - 1 : highlight - 1"
                    @keydown.enter.prevent="
                        const filteredItems = items.filter(item => item.text.toLowerCase().includes(search.toLowerCase()));
                        if (filteredItems[highlight]) {
                            selectedValue = filteredItems[highlight].value;
                            selectedText = filteredItems[highlight].text;
                            open = false;
                            search = '';
                        }
                    "
                    type="text"
                    class="w-full border-0 px-3 py-1.5 text-gray-900 dark:text-white dark:bg-gray-700 placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-yellow-500 rounded-md"
                    placeholder="{{ $placeholder }}"
                />
            </div>
            
            <!-- Options List -->
            <ul
                role="listbox"
                class="py-1"
            >
                <template x-for="(item, index) in items.filter(item => item.text.toLowerCase().includes(search.toLowerCase()))" :key="item.value">
                    <li
                        @click="selectedValue = item.value; selectedText = item.text; open = false; search = ''"
                        :class="{ 
                            'bg-indigo-100 dark:bg-indigo-900': highlight === index,
                            'text-indigo-900 dark:text-indigo-100': selectedValue == item.value
                        }"
                        class="cursor-pointer select-none relative px-3 py-2 hover:bg-indigo-50 dark:hover:bg-indigo-800 text-gray-900 dark:text-white"
                        role="option"
                    >
                        <span class="block truncate" x-text="item.text"></span>
                        
                        <!-- Check mark for selected option -->
                        <span 
                            x-show="selectedValue == item.value"
                            class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600 dark:text-indigo-400"
                        >
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </li>
                </template>
                
                <!-- Empty state when no results found -->
                <template x-if="items.filter(item => item.text.toLowerCase().includes(search.toLowerCase())).length === 0">
                    <li class="cursor-default select-none relative px-3 py-2 text-gray-500 dark:text-gray-400">
                        {{ $emptyMessage }}
                    </li>
                </template>
            </ul>
        </div>
    </div>
</div>