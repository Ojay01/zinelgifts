<!-- resources/views/components/header.blade.php -->
<header class="font-sans bg-black text-yellow-500" x-data="{ openSidebar: false }">
    <!-- Top bar (Visible on larger screens only) -->
    <div class="border-b border-yellow-500 border-opacity-20 hidden sm:block">
        <div class="container mx-auto px-4 py-2 flex flex-wrap justify-between items-center text-xs">
            <!-- Left Section: Language and Location -->
            <div class="flex space-x-4 mb-2 sm:mb-0 items-center">
                <span class="flex items-center space-x-1">
                    <i class="fas fa-globe"></i> <!-- Language Icon (Globe) -->
                    <span>ENGLISH</span>
                </span>
                <span class="flex items-center space-x-1">
                    <i class="fas fa-map-marker-alt"></i> <!-- Location Icon (Map Marker) -->
                    <span>CAMEROON</span>
                </span>
            </div>

            <!-- Center Section: Shipping Notice -->
            <div class="w-full sm:w-auto text-center mb-2 sm:mb-0 sm:hidden lg:block">FREE SHIPPING FOR ALL ORDERS FROM 25,000XAF</div>

            <!-- Right Section: Social Icons and Links -->
            <div class="flex flex-wrap justify-center sm:justify-end space-x-4">
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
            <img src="{{ asset('logo\logo.png') }}" alt="Woodmart" class="h-8">
        </div>

        <!-- Desktop Search and Category (Hidden on small screens) -->
        <div class="hidden sm:flex items-center space-x-4">
            <div class="relative">
                <input
                    type="text"
                    placeholder="Search for products"
                    class="border border-yellow-500 bg-black text-yellow-500 rounded-full py-2 px-4 pr-10 w-full sm:w-64 placeholder-yellow-500 placeholder-opacity-50 focus:border-green-600"
                >
                <i class="fas fa-search absolute right-3 top-2.5 text-yellow-500"></i>
            </div>

            <!-- Category Dropdown with Font Awesome Icons -->
            <div x-data="{ open: false }" class="relative sm:hidden xl:block">
                <button @click="open = !open" class="border border-yellow-500 rounded-full py-2 px-4 bg-black text-yellow-500 flex items-center">
                    <span class="mr-2">SELECT CATEGORY</span>
                    <i :class="{ 'rotate-180': open }" class="fas fa-chevron-down transform transition-transform duration-300"></i>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" @click.away="open = false" class="absolute mt-2 w-full bg-black border border-yellow-300 rounded shadow-lg z-10">
                    <ul class="py-2">
                        <li>
                            <a href="#" class=" px-4 py-2 text-yellow-500 hover:bg-yellow-500 hover:text-black flex items-center">
                                <i class="fas fa-couch mr-2"></i> <!-- Font Awesome icon for category -->
                                Furniture
                            </a>
                        </li>
                        <!-- Add more categories as needed -->
                    </ul>
                </div>
            </div>
        </div>

        <!-- User Actions (Cart, Login, Register) -->
        <div class="flex items-center space-x-4">
            <!-- Login/Register Link (Hidden on small screens) -->
            <a href="#" class="text-sm font-medium hidden sm:inline">LOGIN / REGISTER</a>
            
            <!-- Wishlist Icon -->
            <a href="#" aria-label="Wishlist" class="text-yellow-500">
                <i class="fas fa-heart text-lg"></i>
            </a>
            
            <!-- Cart Icon and Item Count -->
            <div class="relative">
                <a href="#" aria-label="Cart" class="text-yellow-500">
                    <i class="fas fa-shopping-cart text-lg"></i>
                </a>
                <span class="absolute -top-2 -right-2 bg-yellow-500 text-black text-xs rounded-full w-5 h-5 flex items-center justify-center">0</span>
            </div>
        
            <!-- Sidebar Toggle Button (Hamburger Icon for Mobile) -->
            <button id="mobile-menu-button" class="sm:hidden" @click="openSidebar = true">
                <i class="fas fa-bars text-yellow-500 text-2xl"></i> <!-- Font Awesome Hamburger Icon -->
            </button>
        
        </div>
    </div>

        <!-- Navigation -->
        <nav class="border-t border-yellow-500 border-opacity-20">
            <div class="container mx-auto px-4">
                <ul id="nav-menu" class="hidden sm:flex items-center uppercase justify-between py-4">
                    <!-- Left-aligned Category Dropdown -->
                    <li class="font-medium mb-2 sm:mb-0">
                        <x-category-dropdown />
                    </li>
    
                    <!-- Center-aligned Links -->
                    <div class="flex-1 flex justify-center space-x-6">
                        <li class="mb-2 sm:mb-0"><a href="#" class="hover:text-yellow-400">Home</a></li>
                        <li class="mb-2 sm:mb-0"><a href="#" class="hover:text-yellow-400">Shop</a></li>
                        <li class="mb-2 sm:mb-0"><a href="#" class="hover:text-yellow-400">Blogs</a></li>
                    </div>
    
                    <!-- Right-aligned Special Offer -->
                    <li class="mb-2 sm:mb-0">
                        <a href="#" class="text-yellow-300 hover:text-yellow-200">Special Offer</a>
                    </li>
                </ul>
    

            </div>
        </nav>

    <!-- Mobile Sliding Sidebar -->
    <!-- Background overlay to close the sidebar -->
    <div x-show="openSidebar" class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden" @click="openSidebar = false"></div>
    
    <!-- Sidebar itself starts below the navbar -->
    <div x-show="openSidebar" class="fixed top-[65px] inset-y-0 left-0 w-64 bg-black text-yellow-500 shadow-lg z-50 transform transition-transform duration-500 ease-out -translate-x-full md:hidden" :class="{ 'translate-x-0': openSidebar }">
        <div class="p-4">
            <button @click="openSidebar = false" class="text-yellow-500 text-xl">
                <i class="fas fa-times"></i> <!-- Font Awesome Close Icon -->
            </button>
        </div>
        <div class="p-4">

            <div class="mb-4 flex justify-around">
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            </div>
            <!-- Mobile Search -->
            <div class="mb-4 relative">
                <input
                    type="text"
                    placeholder="Search for products"
                    class="border border-yellow-500 bg-black text-yellow-500 rounded-full py-2 px-4 pr-10 w-full placeholder-yellow-500 placeholder-opacity-50 focus:border-green-600"
                >
                <i class="fas fa-search absolute right-5 top-3 text-yellow-500"></i>
            </div>

            <!-- Mobile Category Dropdown -->
            <div x-data="{ open: false }" class="relative mb-4">
                <button @click="open = !open" class="border border-yellow-500 rounded-full py-2 px-4 bg-black text-yellow-500 flex items-center w-full">
                    <span class="mr-2">SELECT CATEGORY</span>
                    <i :class="{ 'rotate-180': open }" class="fas fa-chevron-down transform transition-transform duration-300"></i>
                </button>
                <div x-show="open" class="mt-2 w-full bg-black border border-yellow-300 rounded shadow-lg z-10">
                    <ul class="py-2">
                        <li>
                            <a href="#" class="block px-4 py-2 text-yellow-500 hover:bg-yellow-500 hover:text-black flex items-center">
                                <i class="fas fa-couch mr-2"></i>
                                Furniture
                            </a>
                        </li>
                        <!-- Add more categories as needed -->
                    </ul>
                </div>
            </div>

            <!-- Mobile Navigation Links -->
            <ul class="space-y-2 !justify-center text-center">
                <li><a href="#" class=" hover:text-yellow-400">Home</a></li>
                <li><a href="#" class="block hover:text-yellow-400">Shop</a></li>
                <li><a href="#" class="block hover:text-yellow-400">Blogs</a></li>
                <li><a href="#" class="block text-yellow-300 hover:text-yellow-200">Special Offer</a></li>
            </ul>

        </div>
    </div>
</header>
