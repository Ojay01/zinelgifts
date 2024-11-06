<div x-data="{ 
    open: false, 
    activeCategory: null,
    timeout: null
}" 
    class="relative" 
    @mouseenter="open = true" 
    @mouseleave="open = false; activeCategory = null">
    <button @click="open = !open" :class="{ 'border-yellow-500': open, 'hover:border-yellow-500': !open }"
            class="relative flex items-center justify-between w-full py-2 text-yellow-500 border-b-2 border-transparent duration-300 ease-in-out">
        <span class="flex items-center">
            <i class="fas fa-bars mr-2"></i>
            BROWSE CATEGORIES
        </span>
        <i :class="{ 'rotate-180': open }" class="fas fa-chevron-down transition-transform duration-300 ease-in-out ml-2 transform"></i>
    </button>
    <div x-show="open"  x-cloak class="absolute z-10 w-64 mt-0.5  bg-gray-300 dark:bg-gray-900 border dark:text-yellow-500 border-yellow-300 shadow-lg">
        <ul class="py-1">
            @foreach($categories as $category)
                <li class="relative" 
                    @mouseenter="
                        clearTimeout(timeout);
                        activeCategory = '{{ $category->name }}';
                    " 
                    @mouseleave="
                        timeout = setTimeout(() => {
                            activeCategory = null;
                        }, 100);
                    ">
                    <a href="{{ route('category.show', $category->id) }}" class="flex items-center px-4 py-2 hover:bg-yellow-500 hover:text-black">
                        <i class="fas fa-gift mr-3 text-gray-400"></i> <!-- Change the icon dynamically if needed -->
                        {{ $category->name }}
                        <i class="fas fa-chevron-right ml-auto text-gray-400"></i>
                    </a>
                    <!-- Subcategories dropdown -->
                    <div x-show="activeCategory === '{{ $category->name }}'"  x-cloak
                         class="absolute left-full top-0 w-64 bg-gray-100 dark:bg-gray-800 border border-yellow-300 shadow-lg">
                        <ul class="py-1">
                            @foreach($category->subcategories as $subcategory)
                                <li>
                                    <a href="{{ route('subcategory.show', $subcategory->id) }}" class="block px-4 py-2 hover:bg-yellow-500 hover:text-black">
                                        {{ $subcategory->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
