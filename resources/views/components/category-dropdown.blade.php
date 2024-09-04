<!-- resources/views/components/category-dropdown.blade.php -->
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
    <div x-show="open" class="absolute z-10 w-64 mt-0.5  bg-gray-300 dark:bg-gray-900 border dark:text-yellow-500 border-yellow-300 shadow-lg">
        <ul class="py-1">
            @php
                $categories = [
                    [
                        'name' => 'EVENTS GIFTS',
                        'icon' => 'fa-gift',
                        'subcategories' => ['BIRTHDAY GIFTS', 'WEDDING GIFTS', 'MEMORIAL GIFTS', 'COMEDY SHOWS', 'MOVIE PREMIERS', 'ARTS & CULTURE', 'CONCERTS', 'AWARD CEREMONIES']
                    ],
                    [
                        'name' => 'SPECIAL DAYS GIFTS',
                        'icon' => 'fa-calendar',
                        'subcategories' => ['VALENTINE\'S DAY GIFTS', 'MOTHERS\' DAY GIFTS', 'FATHER\'S DAY GIFTS', 'EASTER GIFTS', 'CHRISTMAS GIFTS', 'NEW YEAR GIFTS', 'LABOUR DAY']
                    ],
                    [
                        'name' => 'CORPORATE GIFTS',
                        'icon' => 'fa-briefcase',
                        'subcategories' => ['NGOS', 'ASSOCIATIONS', 'CONFERENCES', 'SERMINERS', 'COMMON INITIATIVE GROUPS', 'SCHOOLS', 'CHURCHES']
                    ],
                    [
                        'name' => 'HOME & DECORE GIFTS',
                        'icon' => 'fa-home',
                        'subcategories' => ['INTERIOR DÉCOR', 'EVENT DECORE']
                    ],
                    [
                        'name' => 'CONGRATULATION GIFTS',
                        'icon' => 'fa-award',
                        'subcategories' => ['BABY SHOWER', 'GRADUATIONS', 'BAPTISM', 'CONFIRMATION', 'ORDINATION', 'APPOINMENTS']
                    ],
                    [
                        'name' => 'CONSUMABLE GIFTS',
                        'icon' => 'fa-utensils',
                        'subcategories' => ['GIFT BASKETS']
                    ],
                    [
                        'name' => 'LUXURY GIFTS',
                        'icon' => 'fa-gem',
                        'subcategories' => ['BRAND PRODUCTS']
                    ]
                ]
            @endphp
            @foreach($categories as $category)
                <li class="relative" 
                    @mouseenter="
                        clearTimeout(timeout);
                        activeCategory = '{{ $category['name'] }}';
                    " 
                    @mouseleave="
                        timeout = setTimeout(() => {
                            activeCategory = null;
                        }, 100);
                    ">
                    <a href="#" class="flex items-center px-4 py-2 hover:bg-yellow-500 hover:text-black">
                        <i class="fas {{ $category['icon'] }} mr-3 text-gray-400"></i>
                        {{ $category['name'] }}
                        <i class="fas fa-chevron-right ml-auto text-gray-400"></i>
                    </a>
                    <!-- Subcategories dropdown -->
                    <div x-show="activeCategory === '{{ $category['name'] }}'"
                         class="absolute left-full top-0 w-64 bg-gray-100 dark:bg-gray-800 border border-yellow-300 shadow-lg">
                        <ul class="py-1">
                            @foreach($category['subcategories'] as $subcategory)
                                <li>
                                    <a href="#" class="block px-4 py-2 hover:bg-yellow-500 hover:text-black">
                                        {{ $subcategory }}
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