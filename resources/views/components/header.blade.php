<header class="font-sans dark:bg-black transition-colors duration-300" 
    x-data="{ 
        openSidebar: false, 
        showSearch: false, 
        darkMode: localStorage.getItem('darkMode') === 'true',
        toggleDarkMode() {
            this.darkMode = !this.darkMode;
            document.documentElement.classList.toggle('dark', this.darkMode);
            localStorage.setItem('darkMode', this.darkMode);
        }
    }" 
    x-init="$watch('darkMode', value => document.documentElement.classList.toggle('dark', value))">
    
    <!-- Top bar (Visible on larger screens only) -->
    <div class="border-b border-yellow-500 border-opacity-20 hidden sm:block">
        <div class="container mx-auto px-4 py-2 flex flex-wrap justify-between items-center text-xs">
            <!-- Left Section: Language and Location -->
            <div class="flex space-x-4 mb-2 sm:mb-0 items-center">
                <span class="flex items-center space-x-1 dark:text-yellow-500">
                    <i class="fas fa-globe"></i> <!-- Language Icon (Globe) -->
                    <span>ENGLISH</span>
                </span>
                <span class="flex items-center space-x-1 dark:text-yellow-500">
                    <i class="fas fa-map-marker-alt"></i> <!-- Location Icon (Map Marker) -->
                    <span>CAMEROON</span>
                </span>
            </div>

            <!-- Center Section: Shipping Notice -->
            <div class="w-full sm:w-auto text-center mb-2 sm:mb-0 sm:hidden lg:block dark:text-yellow-500">
                FREE SHIPPING FOR ALL ORDERS FROM 25,000XAF
            </div>

            <!-- Dark Mode Toggle Button -->
            <button @click="toggleDarkMode" class="p-2 rounded-full transition-colors duration-300 bg-gray-200 dark:bg-yellow-500 dark:text-black">
                <i :class="darkMode ? 'fas fa-sun' : 'fas fa-moon'"></i>
            </button>
            

            <!-- Right Section: Social Icons and Links -->
            <div class="flex flex-wrap justify-center sm:justify-end space-x-4 dark:text-yellow-500">
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" class="uppercase hidden sm:inline">Newsletter</a>
                <a href="#" class="uppercase hidden sm:inline">Contact Us</a>
                <a href="#" class="uppercase hidden sm:inline">FAQs</a>
            </div>
        </div>
    </div>

    <!-- Main header -->
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <!-- Logo and Mobile Menu Button -->
        <div class="flex items-center space-x-4">
            <!-- Sidebar Toggle Button (Hamburger Icon for Mobile) -->
            <button id="mobile-menu-button" class="sm:hidden" @click="openSidebar = true">
                <i class="fas fa-bars text-2xl dark:text-yellow-500 text-gray-800"></i>
            </button>
            <img :src="darkMode ? darkLogo : lightLogo" alt="Woodmart" class="h-16" 
            x-data="{ 
                darkLogo: '{{ asset('logo/logowhite.png') }}',
                lightLogo: '{{ asset('logo/logo.png') }}'
            }">
       
        </div>

        <!-- Desktop Search and Category (Hidden on small screens) -->
        <div class="hidden sm:flex items-center space-x-4">
            <div class="relative">
                <input
                    type="text"
                    placeholder="Search for products"
                    class="border border-gray-300 bg-white text-gray-800 rounded-full py-2 px-4 pr-10 w-full sm:w-64 placeholder-gray-500 focus:border-green-600 dark:border-yellow-500 dark:bg-black dark:text-yellow-500 dark:placeholder-yellow-500"
                >
                <i class="fas fa-search absolute right-3 top-2.5 text-gray-800 dark:text-yellow-500"></i>
            </div>

            <!-- Category Dropdown with Font Awesome Icons -->
            <div x-data="{ open: false }" class="relative sm:hidden xl:block">
                <button @click="open = !open" class="border border-gray-300 rounded-full py-2 px-4 bg-white text-gray-800 flex items-center dark:border-yellow-500 dark:bg-black dark:text-yellow-500">
                    <span class="mr-2">SELECT CATEGORY</span>
                    <i :class="{ 'rotate-180': open }" class="fas fa-chevron-down transform transition-transform duration-300"></i>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" @click.away="open = false" class="absolute mt-2 w-full bg-white border border-gray-300 rounded shadow-lg z-10 dark:bg-black dark:border-yellow-300">
                    <ul class="py-2">
                        <li>
                            <a href="#" class="px-4 py-2 text-gray-800 hover:bg-gray-200 hover:text-black flex items-center dark:text-yellow-500 dark:hover:bg-yellow-500 dark:hover:text-black">
                                <i class="fas fa-couch mr-2"></i> <!-- Font Awesome icon for category -->
                                Furniture
                            </a>
                        </li>
                        <!-- Add more categories as needed -->
                    </ul>
                </div>
            </div>
        </div>

        <!-- User Actions -->
        <div class="flex items-center space-x-4">
            <!-- Login/Register Link (Hidden on small screens) -->
            <a href="#" class="text-sm font-medium hidden sm:inline text-gray-800 dark:text-yellow-500">LOGIN / REGISTER</a>

            <button @click="toggleDarkMode" class="p-2 rounded-full transition-colors duration-300 bg-gray-200 sm:hidden dark:bg-yellow-500 dark:text-black">
                <i :class="darkMode ? 'fas fa-sun' : 'fas fa-moon'"></i>
            </button> 
            <!-- Mobile Search Toggle Button -->
            <button @click="showSearch = !showSearch" class="sm:hidden text-gray-800 dark:text-yellow-500">
                <i class="fas fa-search text-lg"></i>
            </button> 
            
            <!-- Wishlist Icon -->
            <a href="#" aria-label="Wishlist" class="text-gray-800 dark:text-yellow-500">
                <i class="fas fa-heart text-lg"></i>
            </a>
            
            <!-- Cart Icon and Item Count -->
            <div class="relative">
                <a href="#" aria-label="Cart" class="text-gray-800 dark:text-yellow-500">
                    <i class="fas fa-shopping-cart text-lg"></i>
                </a>
                <span class="absolute -top-2 -right-2 bg-gray-800 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center dark:bg-yellow-500 dark:text-black">0</span>
            </div>
        </div>
    </div>

    <!-- Mobile Search Field (conditionally rendered) -->
    <div 
        x-show="showSearch" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90"
        class="sm:hidden px-4 py-2"
    >
        <div class="relative">
            <input
                type="text"
                placeholder="Search for products"
                class="w-full border border-gray-300 bg-white text-gray-800 rounded-full py-2 px-4 pr-10 placeholder-gray-500 focus:border-green-600 dark:border-yellow-500 dark:bg-black dark:text-yellow-500 dark:placeholder-yellow-500"
            >
            <i class="fas fa-search absolute right-3 top-2.5 text-gray-800 dark:text-yellow-500"></i>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="border-t border-gray-300 border-opacity-20 dark:border-yellow-500">
        <div class="container mx-auto px-4">
            <ul id="nav-menu" class="hidden sm:flex items-center uppercase justify-between py-4">
                <!-- Left-aligned Category Dropdown -->
                <li class="font-medium mb-2 sm:mb-0">
                    <x-category-dropdown />
                </li>

                <!-- Center-aligned Links -->
                <div class="flex-1 flex justify-center space-x-6">
                    <li class="mb-2 sm:mb-0"><a href="#" class="hover:text-yellow-400 dark:hover:text-yellow-800 dark:text-yellow-500">Home</a></li>
                    <li class="mb-2 sm:mb-0"><a href="#" class="hover:text-yellow-400 dark:hover:text-yellow-800 dark:text-yellow-500">Shop</a></li>
                    <li class="mb-2 sm:mb-0"><a href="#" class="hover:text-yellow-400 dark:hover:text-yellow-800 dark:text-yellow-500">Blogs</a></li>
                </div>

                <!-- Right-aligned Special Offer -->
                <li class="mb-2 sm:mb-0">
                    <a href="#" class="text-yellow-800 hover:text-yellow-200  dark:hover:text-yellow-800 dark:text-yellow-500">Special Offer</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Mobile Sliding Sidebar -->
    <div x-show="openSidebar" class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden" @click="openSidebar = false"></div>
    
    <div x-show="openSidebar" class="fixed inset-y-0 left-0 w-64 bg-white text-gray-800 shadow-lg z-50 transform transition-transform duration-500 ease-out -translate-x-full md:hidden flex flex-col dark:bg-black dark:text-yellow-500" :class="{ 'translate-x-0': openSidebar }">
        <!-- Sidebar content container -->
        <div class="flex-grow overflow-y-auto p-4">
            <button @click="openSidebar = false" class="text-gray-800 text-xl mb-4 dark:text-yellow-500">
                <i class="fas fa-times"></i>
            </button>

            <div class="mb-4 flex gap-4">
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            </div>

            <!-- Mobile Navigation Links -->
            <ul class="space-y-2 uppercase text-left">
                <li>
                    <a href="#" class="flex items-center hover:text-yellow-400 dark:hover:text-white">
                        <i class="fas fa-user-plus mr-2"></i> 
                        Register
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center hover:text-yellow-400 dark:hover:text-white">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Login
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center hover:text-yellow-400 dark:hover:text-white">
                        <i class="fas fa-home mr-2"></i> 
                        Home
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center hover:text-yellow-400 dark:hover:text-white">
                        <i class="fas fa-shopping-bag mr-2"></i>
                        Shop
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center hover:text-yellow-400 dark:hover:text-white">
                        <i class="fas fa-blog mr-2"></i>
                        Blogs
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center text-yellow-300 hover:text-yellow-200 dark:text-yellow-200 dark:hover:text-yellow-100">
                        <i class="fas fa-gift mr-2"></i> 
                        Special Offer
                    </a>
                </li>
            </ul>

            <!-- Mobile Category Dropdown (moved after Special Offer) -->
            <div x-data="{ open: false }" class="relative mt-4">
                <button @click="open = !open" class="border border-gray-300 rounded-full py-2 px-4 bg-white text-gray-800 flex items-center w-full dark:border-yellow-500 dark:bg-black dark:text-yellow-500">
                    <span class="mr-2">SELECT CATEGORY</span>
                    <i :class="{ 'rotate-180': open }" class="fas fa-chevron-down transform transition-transform duration-300"></i>
                </button>
                <div x-show="open" class="mt-2 w-full bg-white border border-gray-300 rounded shadow-lg z-10 dark:bg-black dark:border-yellow-300">
                    <ul class="py-2">
                        <li>
                            <a href="#" class="px-4 py-2 text-gray-800 hover:bg-gray-200 hover:text-black flex items-center dark:text-yellow-500 dark:hover:bg-yellow-500 dark:hover:text-black">
                                <i class="fas fa-couch mr-2"></i>
                                Furniture
                            </a>
                        </li>
                        <!-- Add more categories as needed -->
                    </ul>
                </div>
            </div>
        </div>

        <!-- Sign Out Option at the Very Bottom -->
        <div class="p-4 border-t border-gray-300 mt-auto dark:border-yellow-500">
            <ul class="uppercase text-left">
                <li>
                    <a href="#" class="flex items-center hover:text-yellow-400 dark:hover:text-white">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Sign Out
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>

<!-- Dark Mode Script -->
<script>
    // Check for saved theme preference or default to dark mode
    if (localStorage.getItem('darkMode') === null) {
        localStorage.setItem('darkMode', 'true'); // Default to dark mode if no preference is set
    }

    // Apply the theme on initial page load
    if (localStorage.getItem('darkMode') === 'true') {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
</script>
