<!-- resources/views/components/category-dropdown.blade.php -->
<div x-data="{ open: false }" class="relative" @mouseenter="open = true" @mouseleave="open = false">
    <button @click="open = !open" :class="{ 'border-yellow-500': open, 'hover:border-yellow-500': !open }"
            class="relative flex items-center justify-between w-full py-2 text-yellow-500 border-b-2 border-transparent duration-300 ease-in-out">
        <span class="flex items-center">
            <!-- Replace with Font Awesome Bars Icon -->
            <i class="fas fa-bars mr-2"></i>
            BROWSE CATEGORIES
        </span>
        <!-- Rotating arrow icon when dropdown is open -->
        <!-- Replace with Font Awesome Chevron Down Icon -->
        <i :class="{ 'rotate-180': open }" class="fas fa-chevron-down transition-transform duration-300 ease-in-out ml-2 transform"></i>
    </button>
    <div x-show="open" class="absolute z-10 w-full mt-0.5 bg-black border border-yellow-300 shadow-lg">
        <ul class="py-1">
            @php
                $categories = [
                    ['name' => 'Furniture', 'icon' => 'fa-couch'], // Example Font Awesome icon
                    // ['name' => 'Cooking', 'icon' => 'fa-utensils'],
                    // ['name' => 'Accessories', 'icon' => 'fa-gem'],
                    // ['name' => 'Fashion', 'icon' => 'fa-tshirt'],
                    // ['name' => 'Clocks', 'icon' => 'fa-clock'],
                    // ['name' => 'Lighting', 'icon' => 'fa-lightbulb'],
                    // ['name' => 'Toys', 'icon' => 'fa-puzzle-piece'],
                    // ['name' => 'Hand Made', 'icon' => 'fa-hands'],
                    // ['name' => 'Minimalism', 'icon' => 'fa-minus-circle'],
                    // ['name' => 'Electronics', 'icon' => 'fa-tv'],
                    // ['name' => 'Cars', 'icon' => 'fa-car'],
                ]
            @endphp

            @foreach($categories as $category)
                <li>
                    <a href="#" class="flex items-center px-4 py-2 hover:bg-yellow-500 hover:text-black">
                        <!-- Replace with Font Awesome Category Icons -->
                        <i class="fas {{ $category['icon'] }} mr-3 text-gray-400"></i>
                        {{ $category['name'] }}
                        <!-- Replace with Font Awesome Chevron Right Icon -->
                        <i class="fas fa-chevron-right ml-auto text-gray-400"></i>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
