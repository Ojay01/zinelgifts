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

<div {{ $attributes->merge(['class' => 'mb-6']) }} id="select-container-{{ $name }}">
    @if($label)
        <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">{{ $label }}</h3>
    @endif
    
    <div class="relative select-wrapper">
        <!-- Hidden input field that holds the selected value -->
        <input 
            type="hidden" 
            name="{{ $name }}"
            id="select-input-{{ $name }}"
            value="{{ $selected ?? optional($items->first())->{$valueKey} ?? '' }}"
        >
        
        <!-- Dropdown Trigger Button -->
        <button
            id="select-button-{{ $name }}"
            type="button"
            class="relative w-full min-w-[150px] cursor-pointer rounded-lg bg-white dark:bg-gray-800 border-2 border-gray-200 dark:border-gray-700 py-2 pl-3 pr-10 text-left shadow-sm focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-yellow-500 sm:text-sm text-gray-900 dark:text-white"
        >
            <span class="block truncate" id="select-text-{{ $name }}">
                {{ $selected ? ($items->where($valueKey, $selected)->first()->{$displayKey} ?? '') : (optional($items->first())->{$displayKey} ?? 'Select an option') }}
            </span>
            <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </span>
        </button>
        
        <!-- Dropdown Menu -->
        <div 
            id="select-dropdown-{{ $name }}"
            class="hidden absolute z-10 mt-1 w-full rounded-md bg-white dark:bg-gray-800 shadow-lg max-h-60 overflow-y-auto"
        >
            <!-- Search Input -->
            <div class="sticky top-0 z-20 px-2 py-2 bg-white dark:bg-gray-800 border-b dark:border-gray-700">
                <input
                    id="select-search-{{ $name }}"
                    type="text"
                    class="w-full border-0 px-3 py-1.5 text-gray-900 dark:text-white dark:bg-gray-700 placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-yellow-500 rounded-md"
                    placeholder="{{ $placeholder }}"
                />
            </div>
            
            <!-- Options List -->
            <ul
                id="select-options-{{ $name }}"
                role="listbox"
                class="py-1"
            >
                @foreach($items->unique($valueKey) as $item)
                <li
                    data-value="{{ $item->{$valueKey} }}"
                    data-text="{{ ucfirst($item->{$displayKey}) }}"
                    class="select-option cursor-pointer select-none relative px-3 py-2 hover:bg-indigo-50 dark:hover:bg-indigo-800 text-gray-900 dark:text-white {{ $selected == $item->{$valueKey} ? 'text-indigo-900 dark:text-indigo-100' : '' }}"
                    role="option"
                >
                    <span class="block truncate">{{ ucfirst($item->{$displayKey}) }}</span>
                    
                    <!-- Check mark for selected option -->
                    @if($selected == $item->{$valueKey})
                    <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600 dark:text-indigo-400">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    @endif
                </li>
                @endforeach
            </ul>
            
            <!-- Empty state message (initially hidden) -->
            <div id="select-empty-{{ $name }}" class="hidden cursor-default select-none relative px-3 py-2 text-gray-500 dark:text-gray-400">
                {{ $emptyMessage }}
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize the custom select component
    initCustomSelect('{{ $name }}');
});

function initCustomSelect(selectName) {
    const container = document.getElementById(`select-container-${selectName}`);
    const button = document.getElementById(`select-button-${selectName}`);
    const dropdown = document.getElementById(`select-dropdown-${selectName}`);
    const search = document.getElementById(`select-search-${selectName}`);
    const options = document.getElementById(`select-options-${selectName}`);
    const emptyMessage = document.getElementById(`select-empty-${selectName}`);
    const hiddenInput = document.getElementById(`select-input-${selectName}`);
    const displayText = document.getElementById(`select-text-${selectName}`);
    const optionItems = options.querySelectorAll('.select-option');
    
    let isOpen = false;
    let highlightIndex = -1;
    let filteredOptions = Array.from(optionItems);
    
    // Toggle dropdown when button is clicked
    button.addEventListener('click', function(e) {
        e.preventDefault();
        toggleDropdown();
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!container.contains(e.target) && isOpen) {
            closeDropdown();
        }
    });
    
    // Handle escape key to close dropdown
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && isOpen) {
            closeDropdown();
        }
    });
    
    // Handle search input
    search.addEventListener('input', function() {
        filterOptions();
        highlightIndex = -1;
    });
    
    // Handle keyboard navigation
    search.addEventListener('keydown', function(e) {
        if (!isOpen) return;
        
        switch (e.key) {
            case 'ArrowDown':
                e.preventDefault();
                navigateOptions(1);
                break;
            case 'ArrowUp':
                e.preventDefault();
                navigateOptions(-1);
                break;
            case 'Enter':
                e.preventDefault();
                if (highlightIndex >= 0 && highlightIndex < filteredOptions.length) {
                    selectOption(filteredOptions[highlightIndex]);
                }
                break;
        }
    });
    
    // Set up click handlers for each option
    optionItems.forEach(option => {
        option.addEventListener('click', function() {
            selectOption(option);
        });
    });
    
    // Function to toggle dropdown visibility
    function toggleDropdown() {
        if (isOpen) {
            closeDropdown();
        } else {
            openDropdown();
        }
    }
    
    // Function to open dropdown
    function openDropdown() {
        dropdown.classList.remove('hidden');
        dropdown.classList.add('block');
        search.focus();
        search.value = '';
        filterOptions();
        isOpen = true;
        
        // Reset highlight
        highlightIndex = -1;
        updateHighlight();
    }
    
    // Function to close dropdown
    function closeDropdown() {
        dropdown.classList.add('hidden');
        dropdown.classList.remove('block');
        isOpen = false;
    }
    
    // Function to filter options based on search input
    function filterOptions() {
        const searchTerm = search.value.toLowerCase();
        let hasVisibleOptions = false;
        
        filteredOptions = [];
        
        optionItems.forEach(option => {
            const text = option.getAttribute('data-text').toLowerCase();
            if (text.includes(searchTerm)) {
                option.style.display = '';
                hasVisibleOptions = true;
                filteredOptions.push(option);
            } else {
                option.style.display = 'none';
            }
        });
        
        // Show/hide empty message
        if (hasVisibleOptions) {
            emptyMessage.style.display = 'none';
        } else {
            emptyMessage.style.display = 'block';
        }
    }
    
    // Function to navigate options with keyboard
    function navigateOptions(direction) {
        if (filteredOptions.length === 0) return;
        
        highlightIndex = (highlightIndex + direction) % filteredOptions.length;
        if (highlightIndex < 0) highlightIndex = filteredOptions.length - 1;
        
        updateHighlight();
    }
    
    // Function to update visual highlight
    function updateHighlight() {
        filteredOptions.forEach((option, index) => {
            if (index === highlightIndex) {
                option.classList.add('bg-indigo-100', 'dark:bg-indigo-900');
            } else {
                option.classList.remove('bg-indigo-100', 'dark:bg-indigo-900');
            }
        });
        
        // Scroll highlighted option into view if needed
        if (highlightIndex >= 0 && filteredOptions[highlightIndex]) {
            filteredOptions[highlightIndex].scrollIntoView({
                block: 'nearest',
                inline: 'nearest'
            });
        }
    }
    
    // Function to select an option
    function selectOption(option) {
        const value = option.getAttribute('data-value');
        const text = option.getAttribute('data-text');
        
        // Update hidden input and display text
        hiddenInput.value = value;
        displayText.textContent = text;
        
        // Update visual state
        optionItems.forEach(item => {
            const checkmark = item.querySelector('span:last-child');
            if (item === option) {
                item.classList.add('text-indigo-900', 'dark:text-indigo-100');
                
                // Add checkmark if it doesn't exist
                if (!checkmark || !checkmark.querySelector('svg')) {
                    const newCheckmark = document.createElement('span');
                    newCheckmark.className = 'absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600 dark:text-indigo-400';
                    newCheckmark.innerHTML = `
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    `;
                    item.appendChild(newCheckmark);
                }
            } else {
                item.classList.remove('text-indigo-900', 'dark:text-indigo-100');
                
                // Remove checkmark if it exists
                if (checkmark && checkmark.querySelector('svg')) {
                    item.removeChild(checkmark);
                }
            }
        });
        
        // Close dropdown
        closeDropdown();
    }
}
</script>