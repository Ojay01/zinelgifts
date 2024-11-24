<aside 
:class="{
    'translate-x-0': mobileMenuOpen || sidebarOpen,
    '-translate-x-full': !mobileMenuOpen && !sidebarOpen,
    'w-64': sidebarOpen,
    'w-20': !sidebarOpen,
    'fixed inset-y-0 left-0': isMobile,
    'sticky top-0 left-0 h-screen': !isMobile
}"
class="flex flex-col bg-slate-800 z-40 transition-all duration-300 md:translate-x-0 border-r border-slate-700"
>
<!-- Logo Section -->
<div class="flex items-center px-4 sticky top-0 bg-slate-800 z-10">
    <div x-show="sidebarOpen" 
         class="flex ">
         <img class="p-4 w-48" src="{{asset('logo/logowhite.png')}}" />
    </div>
    <div x-show="!sidebarOpen" x-cloak class="flex text-xl text-yellow-500 font-bold pt-5 ml-32">
        ZINELGIFTS
   </div>
</div>

<!-- Navigation Menu -->
<nav class="flex-1 mt-4 px-3 overflow-y-auto">
<div class="space-y-1" x-data="{ activeSection: 'dashboard', openSection: 'main' }">
    <!-- Main Section -->
    <div class="mb-4">
        <button @click="openSection = openSection === 'main' ? null : 'main'"
                class="flex items-center justify-between w-full px-3 py-2 text-xs font-semibold text-slate-400 uppercase tracking-wider hover:text-slate-300 transition-colors"
                x-show="sidebarOpen">
            <span>Overview</span>
            <svg class="h-4 w-4 transition-transform duration-200"
                 :class="{'rotate-180': openSection === 'main'}"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
        
        <div x-show="openSection === 'main' || !sidebarOpen" 
             x-transition:enter="transition-all ease-in-out duration-300"
             x-transition:enter-start="opacity-0 max-h-0"
             x-transition:enter-end="opacity-100 max-h-96"
             x-transition:leave="transition-all ease-in-out duration-300"
             x-transition:leave-start="opacity-100 max-h-96"
             x-transition:leave-end="opacity-0 max-h-0"
             class="mt-2 space-y-1 overflow-hidden">
            
            <!-- Dashboard -->
            <a href="{{ route('admin') }}" 
            class="flex items-center w-full px-3 py-2 rounded-lg transition-colors group"
            :class="{
                'bg-blue-500 text-white': '{{ Request::routeIs('admin') }}' ,
                'text-slate-400 hover:bg-slate-700 hover:text-white': !'{{ Request::routeIs('admin') }}' && activeSection !== 'dashboard'
            }"
            @click="activeSection = 'dashboard'">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path>
            </svg>
            <span x-show="sidebarOpen" class="ml-3">Dashboard</span>
            <div x-show="!sidebarOpen" 
                 class="absolute left-20 ml-1 px-2 py-1 bg-slate-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                Dashboard
            </div>
         </a>
         
        
        

            <!-- Users -->
            <a href="{{ route('users.index') }}" 
            class="flex items-center w-full px-3 py-2 rounded-lg transition-colors group"
            :class="{'bg-blue-500 text-white': activeSection === 'users' || '{{ request()->routeIs('users.index', 'profile.user', 'users.edit') ? 'true' : 'false' }}' === 'true',
                    'text-slate-400 hover:bg-slate-700 hover:text-white': !(activeSection === 'users' || '{{ request()->routeIs('users.index', 'profile.user',  'users.edit') ? 'true' : 'false' }}' === 'true')}">
             <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                       d="M17 20h5v-1a3 3 0 00-3-3h-4a3 3 0 00-3 3v1h5zm-4-6a4 4 0 118 0 4 4 0 01-8 0zM4 20h5v-1a3 3 0 00-3-3H2a3 3 0 00-3 3v1h5zm-4-6a4 4 0 118 0 4 4 0 01-8 0z" />
             </svg>
             <span x-show="sidebarOpen" class="ml-3">Users</span>
             <div x-show="!sidebarOpen" 
                  class="absolute left-20 ml-1 px-2 py-1 bg-slate-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                 Users
             </div>
         </a>
         
        </div>
    </div>


    <!-- Products & Inventory -->
    <div class="mb-4">
        <button 
            @click="openSection = openSection === 'products' ? null : 'products'"
            class="flex items-center justify-between w-full px-3 py-2 text-xs font-semibold text-slate-400 uppercase tracking-wider hover:text-slate-300 transition-colors"
            x-show="sidebarOpen">
            <span>Products</span>
            <svg class="h-4 w-4 transition-transform duration-200"
                 :class="{'rotate-180': openSection === 'products'}"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
    
        <div 
            x-show="openSection === 'products' || '{{ Request::routeIs( 'categories.*', 'subcat', 'wishlist.user', 'carts.user', 'products.*' ) }}'"
            x-transition:enter="transition-all ease-in-out duration-300"
            x-transition:enter-start="opacity-0 max-h-0"
            x-transition:enter-end="opacity-100 max-h-96"
            x-transition:leave="transition-all ease-in-out duration-300"
            x-transition:leave-start="opacity-100 max-h-96"
            x-transition:leave-end="opacity-0 max-h-0"
            class="mt-2 space-y-1">
            
            <!-- All Products -->
            <a href="{{route('products.index')}}"
               @click="activeSection = 'all-products'"
               class="flex items-center w-full px-3 py-2 rounded-lg transition-colors group"
               :class="{'bg-blue-500 text-white':'{{ Request::routeIs('products.*') }}',
                        'text-slate-400 hover:bg-slate-700 hover:text-white': !'{{ Request::routeIs('products.*') }}' && activeSection !== 'all-products'}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                <span x-show="sidebarOpen" class="ml-3">All Products</span>
                <div x-show="!sidebarOpen" 
                     class="absolute left-20 ml-1 px-2 py-1 bg-slate-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                    All Products
                </div>
            </a>
    
            <!-- Categories -->
            <a href="{{ route('categories.index') }}"
               @click="activeSection = 'categories'"
               class="flex items-center w-full px-3 py-2 rounded-lg transition-colors group"
               :class="{
                    'bg-blue-500 text-white': '{{ Request::routeIs('categories.*', 'subcat') }}',
                    'text-slate-400 hover:bg-slate-700 hover:text-white': !'{{ Request::routeIs('categories.*', 'subcat') }}' && activeSection !== 'categories'
                }">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <span x-show="sidebarOpen" class="ml-3">Categories</span>
                <div x-show="!sidebarOpen" 
                     class="absolute left-20 ml-1 px-2 py-1 bg-slate-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                    Categories
                </div>
            </a>
    
            <!-- Inventory -->
            <a href="{{route('wishlist.user')}}"
            @click="activeSection = 'wishlist'"
            class="flex items-center w-full px-3 py-2 rounded-lg transition-colors group"
            :class="{'bg-blue-500 text-white': '{{ Request::routeIs('wishlist.user') }}',
                     'text-slate-400 hover:bg-slate-700 hover:text-white': !'{{ Request::routeIs('wishlist.user') }}' && activeSection !== 'wishlist'}">
             <!-- Wishlist Icon -->
             <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                       d="M4 6.5C4 4.014 6.014 2 8.5 2S13 4.014 13 6.5C13 9 8.5 12 8.5 12S4 9 4 6.5zM8.5 4a2.5 2.5 0 000 5 2.5 2.5 0 000-5z" />
             </svg>
             <span x-show="sidebarOpen" class="ml-3">Users Wishlist</span>
             <div x-show="!sidebarOpen" 
                  class="absolute left-20 ml-1 px-2 py-1 bg-slate-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                 User's Wishlist
             </div>
         </a>
         
         <a href="{{route('carts.user')}}"
            @click="activeSection = 'carts'"
            class="flex items-center w-full px-3 py-2 rounded-lg transition-colors group"
            :class="{'bg-blue-500 text-white': '{{ Request::routeIs('carts.user') }}',
                     'text-slate-400 hover:bg-slate-700 hover:text-white': !'{{ Request::routeIs('carts.user') }}' && activeSection !== 'carts'}">
             <!-- Cart Icon -->
             <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                       d="M3 3h2l.4 2M6 6h15l1-2H6M6 6l-1 8h13l1-8H6M8 16a2 2 0 110 4 2 2 0 010-4zm8 0a2 2 0 110 4 2 2 0 010-4z" />
             </svg>
             <span x-show="sidebarOpen" class="ml-3">Carts</span>
             <div x-show="!sidebarOpen" 
                  class="absolute left-20 ml-1 px-2 py-1 bg-slate-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                 Carts
             </div>
         </a>
         
        </div>
    </div>

    <div class="mb-4" x-data="{ 
        openSection: '{{ Request::routeIs("sizes.index", "types.index", "qualities.index", "colors.index") ? "attributes" : null }}' 
    }">
        <!-- Attributes Section -->
        <button @click="openSection = openSection === 'attributes' ? null : 'attributes'"
                class="flex items-center justify-between w-full px-3 py-2 text-xs font-semibold text-slate-400 uppercase tracking-wider hover:text-slate-300 transition-colors"
                x-show="sidebarOpen">
            <span>Attributes</span>
            <svg class="h-4 w-4 transition-transform duration-200"
                 :class="{'rotate-180': openSection === 'attributes'}"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
    
        <div x-show="openSection === 'attributes' || !sidebarOpen"
             x-transition:enter="transition-all ease-in-out duration-300"
             x-transition:enter-start="opacity-0 max-h-0"
             x-transition:enter-end="opacity-100 max-h-96"
             x-transition:leave="transition-all ease-in-out duration-300"
             x-transition:leave-start="opacity-100 max-h-96"
             x-transition:leave-end="opacity-0 max-h-0"
             class="mt-2 space-y-1">
            
            <!-- Sizes -->
            <a href="{{ route('sizes.index') }}" 
               class="flex items-center w-full px-3 py-2 rounded-lg transition-colors group"
               :class="{
                   'bg-blue-500 text-white': '{{ Request::routeIs('sizes.index') }}',
                   'text-slate-400 hover:bg-slate-700 hover:text-white': !'{{ Request::routeIs('sizes.index') }}' 
               }"
               @click="activeSection = 'sizes'">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18M3 18h18"></path>
                </svg>
                <span x-show="sidebarOpen" class="ml-3">Sizes</span>
            </a>
    
            <!-- Type -->
            <a href="{{ route('types.index') }}" 
               class="flex items-center w-full px-3 py-2 rounded-lg transition-colors group"
               :class="{
                   'bg-blue-500 text-white': '{{ Request::routeIs('types.index') }}',
                   'text-slate-400 hover:bg-slate-700 hover:text-white': !'{{ Request::routeIs('types.index') }}'
               }"
               @click="activeSection = 'types'">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                <span x-show="sidebarOpen" class="ml-3">Type</span>
            </a>
    
            <!-- Quality -->
            <a href="{{ route('qualities.index') }}" 
               class="flex items-center w-full px-3 py-2 rounded-lg transition-colors group"
               :class="{
                   'bg-blue-500 text-white': '{{ Request::routeIs('qualities.index') }}',
                   'text-slate-400 hover:bg-slate-700 hover:text-white': !'{{ Request::routeIs('qualities.index') }}'
               }"
               @click="activeSection = 'qualities'">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16m-7 6h7m-7 6h7"></path>
                </svg>
                <span x-show="sidebarOpen" class="ml-3">Quality</span>
            </a>
    
            <!-- Color -->
            <a href="{{ route('colors.index') }}" 
               class="flex items-center w-full px-3 py-2 rounded-lg transition-colors group"
               :class="{
                   'bg-blue-500 text-white': '{{ Request::routeIs('colors.index') }}',
                   'text-slate-400 hover:bg-slate-700 hover:text-white': !'{{ Request::routeIs('colors.index') }}'
               }"
               @click="activeSection = 'colors'">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16M4 12h16"></path>
                </svg>
                <span x-show="sidebarOpen" class="ml-3">Color</span>
            </a>
        </div>
    </div>
    
    
    <!-- Orders -->
    <div class="mb-4">
        <button @click="openSection = openSection === 'orders' ? null : 'orders'"
                class="flex items-center justify-between w-full px-3 py-2 text-xs font-semibold text-slate-400 uppercase tracking-wider hover:text-slate-300 transition-colors"
                x-show="sidebarOpen">
            <span>Orders</span>
            <svg class="h-4 w-4 transition-transform duration-200"
                 :class="{'rotate-180': openSection === 'orders'}"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
        
        <div x-show="openSection === 'orders' || !sidebarOpen"
             x-transition:enter="transition-all ease-in-out duration-300"
             x-transition:enter-start="opacity-0 max-h-0"
             x-transition:enter-end="opacity-100 max-h-96"
             x-transition:leave="transition-all ease-in-out duration-300"
             x-transition:leave-start="opacity-100 max-h-96"
             x-transition:leave-end="opacity-0 max-h-0"
             class="mt-2 space-y-1">
            
            <!-- All Orders -->
            <a href="#" @click="activeSection = 'all-orders'"
                    class="flex items-center w-32 px-3 py-2 rounded-lg transition-colors group"
                    :class="{'bg-blue-500 text-white': activeSection === 'all-orders',
                            'text-slate-400 hover:bg-slate-700 hover:text-white': activeSection !== 'all-orders'}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                <span x-show="sidebarOpen" class="ml-3">All Orders</span>
                <div x-show="!sidebarOpen" class="absolute w-full left-20 ml-1 px-2 py-1 bg-slate-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                    All Orders
                </div>
            </a>

            <!-- Pending Orders -->
            <a href="#" @click="activeSection = 'pending-orders'"
            class="flex items-center w-full px-3 py-2 rounded-lg transition-colors group"
            :class="{'bg-blue-500 text-white': activeSection === 'pending-orders',
                     'text-slate-400 hover:bg-slate-700 hover:text-white': activeSection !== 'pending-orders'}">
             <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
             </svg>
             <span x-show="sidebarOpen" class="ml-3">Pending Orders</span>
             <div x-show="!sidebarOpen" 
                  class="absolute left-20 ml-1 px-2 py-1 bg-slate-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                  role="tooltip">
                 Pending Orders
             </div>
         </a>
    </div>
</nav>
<!-- User Profile Section -->
<div class="sticky bottom-0 left-0 right-0 p-4 border-t border-slate-700 bg-slate-800">
    <div x-show="sidebarOpen" 
         class="flex items-center p-2 rounded-lg hover:bg-slate-700 transition-colors cursor-pointer group">
        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center ring-2 ring-slate-700 group-hover:ring-slate-600">
            <span class="text-sm font-medium">JD</span>
        </div>
        <div class="ml-3">
            <p class="text-sm font-medium">John Doe</p>
            <p class="text-xs text-slate-400">Administrator</p>
        </div>
        <svg class="ml-auto h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </div>
</div>
</aside>