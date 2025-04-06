<aside 
  x-data="{ isMobile: window.innerWidth < 768 }"
  x-init="window.addEventListener('resize', () => { isMobile = window.innerWidth < 768 })"
  :class="{
    'translate-x-0': mobileMenuOpen || sidebarOpen,
    '-translate-x-full': !mobileMenuOpen && !sidebarOpen,
    'w-64': sidebarOpen,
    'w-16': !sidebarOpen,
    'fixed inset-y-0 left-0 z-50': isMobile,
    'sticky top-0 left-0 h-screen': !isMobile
  }"
  class="flex flex-col bg-slate-800 transition-all duration-300 md:translate-x-0 border-r border-slate-700 z-20"
>
  <!-- Logo Section -->
  <div class="flex items-center px-4 sticky top-0 bg-slate-800 z-10 py-3">
    <div x-show="sidebarOpen" class="flex">
      <img class="p-2 h-24 w-48" src="{{asset('logo/logowhite.png')}}" alt="ZINELGIFTS Logo" />
    </div>
    <div x-show="!sidebarOpen" x-cloak class="flex text-xl text-yellow-500 font-bold py-2 mx-auto">
      <img class="w-6 h-6 " src="{{asset('/favicon.ico')}}" alt="ZINELGIFTS Logo" />
    </div>
  </div>

  <!-- Navigation Menu -->
  <nav class="flex-1 mt-2 px-2 overflow-y-auto">
    <div class="space-y-1" x-data="{ activeSection: '{{ Request::segment(2) || 'dashboard' }}', openSection: null }">
      <!-- Main Section -->
      <div class="mb-3">
        <button @click="openSection = openSection === 'main' ? null : 'main'"
                class="flex items-center justify-between w-full px-3 py-2 text-xs font-semibold text-slate-400 uppercase tracking-wider hover:text-slate-300 transition-colors"
                x-show="sidebarOpen">
            <span>Overview</span>
            <i class="fas fa-chevron-down text-xs transition-transform duration-200"
               :class="{'rotate-180': openSection === 'main'}"></i>
        </button>
        
        <div x-show="openSection === 'main' || !sidebarOpen || '{{ Request::routeIs('admin', 'users.index', 'profile.user', 'users.edit') }}'"
             x-transition:enter="transition-all ease-in-out duration-300"
             x-transition:enter-start="opacity-0 max-h-0"
             x-transition:enter-end="opacity-100 max-h-96"
             x-transition:leave="transition-all ease-in-out duration-300"
             x-transition:leave-start="opacity-100 max-h-96"
             x-transition:leave-end="opacity-0 max-h-0"
             class="mt-1 space-y-1 overflow-hidden">
            
            <!-- Dashboard -->
            <a href="{{ route('admin') }}" 
               class="flex items-center w-full px-3 py-2 rounded-lg transition-colors group"
               :class="{
                 'bg-blue-500 text-white': '{{ Request::routeIs('admin') }}',
                 'text-slate-400 hover:bg-slate-700 hover:text-white': !'{{ Request::routeIs('admin') }}'
               }">
              <i class="fas fa-tachometer-alt w-5 text-center"></i>
              <span x-show="sidebarOpen" class="ml-3 text-sm">Dashboard</span>
              <div x-show="!sidebarOpen" 
                   class="absolute left-16 ml-1 px-2 py-1 bg-slate-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none whitespace-nowrap z-50">
                Dashboard
              </div>
            </a>
            
            <!-- Users -->
            <a href="{{ route('users.index') }}" 
               class="flex items-center w-full px-3 py-2 rounded-lg transition-colors group"
               :class="{
                 'bg-blue-500 text-white': '{{ request()->routeIs('users.index', 'profile.user', 'users.edit') ? 'true' : 'false' }}' === 'true',
                 'text-slate-400 hover:bg-slate-700 hover:text-white': '{{ request()->routeIs('users.index', 'profile.user', 'users.edit') ? 'true' : 'false' }}' !== 'true'
               }">
              <i class="fas fa-users w-5 text-center"></i>
              <span x-show="sidebarOpen" class="ml-3 text-sm">Users</span>
              <div x-show="!sidebarOpen" 
                   class="absolute left-16 ml-1 px-2 py-1 bg-slate-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none whitespace-nowrap z-50">
                Users
              </div>
            </a>
        </div>
      </div>

      <!-- Products & Inventory -->
      <div class="mb-3">
        <button 
          @click="openSection = openSection === 'products' ? null : 'products'"
          class="flex items-center justify-between w-full px-3 py-2 text-xs font-semibold text-slate-400 uppercase tracking-wider hover:text-slate-300 transition-colors"
          x-show="sidebarOpen">
          <span>Products</span>
          <i class="fas fa-chevron-down text-xs transition-transform duration-200"
             :class="{'rotate-180': openSection === 'products'}"></i>
        </button>
      
        <div 
          x-show="openSection === 'products' || !sidebarOpen || '{{ Request::routeIs('categories.*', 'subcat', 'wishlist.user', 'carts.user', 'products.*') }}'"
          x-transition:enter="transition-all ease-in-out duration-300"
          x-transition:enter-start="opacity-0 max-h-0"
          x-transition:enter-end="opacity-100 max-h-96"
          x-transition:leave="transition-all ease-in-out duration-300"
          x-transition:leave-start="opacity-100 max-h-96"
          x-transition:leave-end="opacity-0 max-h-0"
          class="mt-1 space-y-1">
          
          <!-- All Products -->
          <a href="{{route('products.index')}}"
             class="flex items-center w-full px-3 py-2 rounded-lg transition-colors group"
             :class="{
               'bg-blue-500 text-white': '{{ Request::routeIs('products.*') }}',
               'text-slate-400 hover:bg-slate-700 hover:text-white': !'{{ Request::routeIs('products.*') }}'
             }">
            <i class="fas fa-box w-5 text-center"></i>
            <span x-show="sidebarOpen" class="ml-3 text-sm">All Products</span>
            <div x-show="!sidebarOpen" 
                 class="absolute left-16 ml-1 px-2 py-1 bg-slate-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none whitespace-nowrap z-50">
              All Products
            </div>
          </a>
      
          <!-- Categories -->
          <a href="{{ route('categories.index') }}"
             class="flex items-center w-full px-3 py-2 rounded-lg transition-colors group"
             :class="{
               'bg-blue-500 text-white': '{{ Request::routeIs('categories.*', 'subcat') }}',
               'text-slate-400 hover:bg-slate-700 hover:text-white': !'{{ Request::routeIs('categories.*', 'subcat') }}'
             }">
            <i class="fas fa-folder w-5 text-center"></i>
            <span x-show="sidebarOpen" class="ml-3 text-sm">Categories</span>
            <div x-show="!sidebarOpen" 
                 class="absolute left-16 ml-1 px-2 py-1 bg-slate-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none whitespace-nowrap z-50">
              Categories
            </div>
          </a>
      
          <!-- Wishlist -->
          <a href="{{route('wishlist.user')}}"
             class="flex items-center w-full px-3 py-2 rounded-lg transition-colors group"
             :class="{
               'bg-blue-500 text-white': '{{ Request::routeIs('wishlist.user') }}',
               'text-slate-400 hover:bg-slate-700 hover:text-white': !'{{ Request::routeIs('wishlist.user') }}'
             }">
            <i class="fas fa-heart w-5 text-center"></i>
            <span x-show="sidebarOpen" class="ml-3 text-sm">Users Wishlist</span>
            <div x-show="!sidebarOpen" 
                 class="absolute left-16 ml-1 px-2 py-1 bg-slate-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none whitespace-nowrap z-50">
              User's Wishlist
            </div>
          </a>
         
          <!-- Carts -->
          <a href="{{route('carts.user')}}"
             class="flex items-center w-full px-3 py-2 rounded-lg transition-colors group"
             :class="{
               'bg-blue-500 text-white': '{{ Request::routeIs('carts.user') }}',
               'text-slate-400 hover:bg-slate-700 hover:text-white': !'{{ Request::routeIs('carts.user') }}'
             }">
            <i class="fas fa-shopping-cart w-5 text-center"></i>
            <span x-show="sidebarOpen" class="ml-3 text-sm">Carts</span>
            <div x-show="!sidebarOpen" 
                 class="absolute left-16 ml-1 px-2 py-1 bg-slate-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none whitespace-nowrap z-50">
              Carts
            </div>
          </a>
        </div>
      </div>

      <!-- Attributes Section -->
      <div class="mb-3" x-data="{ 
          isOpen: '{{ Request::routeIs("sizes.index", "types.index", "qualities.index", "colors.index") ? true : false }}' 
      }">
        <button @click="openSection = openSection === 'attributes' ? null : 'attributes'"
                class="flex items-center justify-between w-full px-3 py-2 text-xs font-semibold text-slate-400 uppercase tracking-wider hover:text-slate-300 transition-colors"
                x-show="sidebarOpen">
          <span>Attributes</span>
          <i class="fas fa-chevron-down text-xs transition-transform duration-200"
             :class="{'rotate-180': openSection === 'attributes'}"></i>
        </button>
      
        <div x-show="openSection === 'attributes' || !sidebarOpen || '{{ Request::routeIs("sizes.index", "types.index", "qualities.index", "colors.index") }}'"
             x-transition:enter="transition-all ease-in-out duration-300"
             x-transition:enter-start="opacity-0 max-h-0"
             x-transition:enter-end="opacity-100 max-h-96"
             x-transition:leave="transition-all ease-in-out duration-300"
             x-transition:leave-start="opacity-100 max-h-96"
             x-transition:leave-end="opacity-0 max-h-0"
             class="mt-1 space-y-1">
          
          <!-- Sizes -->
          <a href="{{ route('sizes.index') }}" 
             class="flex items-center w-full px-3 py-2 rounded-lg transition-colors group"
             :class="{
               'bg-blue-500 text-white': '{{ Request::routeIs('sizes.index') }}',
               'text-slate-400 hover:bg-slate-700 hover:text-white': !'{{ Request::routeIs('sizes.index') }}'
             }">
            <i class="fas fa-ruler w-5 text-center"></i>
            <span x-show="sidebarOpen" class="ml-3 text-sm">Sizes</span>
            <div x-show="!sidebarOpen" 
                 class="absolute left-16 ml-1 px-2 py-1 bg-slate-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none whitespace-nowrap z-50">
              Sizes
            </div>
          </a>
      
          <!-- Type -->
          <a href="{{ route('types.index') }}" 
             class="flex items-center w-full px-3 py-2 rounded-lg transition-colors group"
             :class="{
               'bg-blue-500 text-white': '{{ Request::routeIs('types.index') }}',
               'text-slate-400 hover:bg-slate-700 hover:text-white': !'{{ Request::routeIs('types.index') }}'
             }">
            <i class="fas fa-tags w-5 text-center"></i>
            <span x-show="sidebarOpen" class="ml-3 text-sm">Type</span>
            <div x-show="!sidebarOpen" 
                 class="absolute left-16 ml-1 px-2 py-1 bg-slate-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none whitespace-nowrap z-50">
              Type
            </div>
          </a>
      
          <!-- Quality -->
          <a href="{{ route('qualities.index') }}" 
             class="flex items-center w-full px-3 py-2 rounded-lg transition-colors group"
             :class="{
               'bg-blue-500 text-white': '{{ Request::routeIs('qualities.index') }}',
               'text-slate-400 hover:bg-slate-700 hover:text-white': !'{{ Request::routeIs('qualities.index') }}'
             }">
            <i class="fas fa-star w-5 text-center"></i>
            <span x-show="sidebarOpen" class="ml-3 text-sm">Quality</span>
            <div x-show="!sidebarOpen" 
                 class="absolute left-16 ml-1 px-2 py-1 bg-slate-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none whitespace-nowrap z-50">
              Quality
            </div>
          </a>
      
          <!-- Color -->
          <a href="{{ route('colors.index') }}" 
             class="flex items-center w-full px-3 py-2 rounded-lg transition-colors group"
             :class="{
               'bg-blue-500 text-white': '{{ Request::routeIs('colors.index') }}',
               'text-slate-400 hover:bg-slate-700 hover:text-white': !'{{ Request::routeIs('colors.index') }}'
             }">
            <i class="fas fa-palette w-5 text-center"></i>
            <span x-show="sidebarOpen" class="ml-3 text-sm">Color</span>
            <div x-show="!sidebarOpen" 
                 class="absolute left-16 ml-1 px-2 py-1 bg-slate-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none whitespace-nowrap z-50">
              Color
            </div>
          </a>
        </div>
      </div>
      
      <!-- Orders -->
      <div class="mb-3">
        <button @click="openSection = openSection === 'orders' ? null : 'orders'"
                class="flex items-center justify-between w-full px-3 py-2 text-xs font-semibold text-slate-400 uppercase tracking-wider hover:text-slate-300 transition-colors"
                x-show="sidebarOpen">
          <span>Orders</span>
          <i class="fas fa-chevron-down text-xs transition-transform duration-200"
             :class="{'rotate-180': openSection === 'orders'}"></i>
        </button>
        
        <div x-show="openSection === 'orders' || !sidebarOpen"
             x-transition:enter="transition-all ease-in-out duration-300"
             x-transition:enter-start="opacity-0 max-h-0"
             x-transition:enter-end="opacity-100 max-h-96"
             x-transition:leave="transition-all ease-in-out duration-300"
             x-transition:leave-start="opacity-100 max-h-96"
             x-transition:leave-end="opacity-0 max-h-0"
             class="mt-1 space-y-1">
          
          <!-- All Orders -->
          <a href="#" 
             class="flex items-center w-full px-3 py-2 rounded-lg transition-colors group"
             :class="{
               'bg-blue-500 text-white': '{{ Request::routeIs('orders.index') }}',
               'text-slate-400 hover:bg-slate-700 hover:text-white': !'{{ Request::routeIs('orders.index') }}'
             }">
            <i class="fas fa-shopping-bag w-5 text-center"></i>
            <span x-show="sidebarOpen" class="ml-3 text-sm">All Orders</span>
            <div x-show="!sidebarOpen" 
                 class="absolute left-16 ml-1 px-2 py-1 bg-slate-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none whitespace-nowrap z-50">
              All Orders
            </div>
          </a>

          <!-- Pending Orders -->
          <a href="#" 
             class="flex items-center w-full px-3 py-2 rounded-lg transition-colors group"
             :class="{
               'bg-blue-500 text-white': '{{ Request::routeIs('orders.pending') }}',
               'text-slate-400 hover:bg-slate-700 hover:text-white': !'{{ Request::routeIs('orders.pending') }}'
             }">
            <i class="fas fa-clock w-5 text-center"></i>
            <span x-show="sidebarOpen" class="ml-3 text-sm">Pending Orders</span>
            <div x-show="!sidebarOpen" 
                 class="absolute left-16 ml-1 px-2 py-1 bg-slate-900 text-white text-sm rounded-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none whitespace-nowrap z-50">
              Pending Orders
            </div>
          </a>
        </div>
      </div>
    </div>
  </nav>

  <!-- User Profile Section -->
  <div class="sticky bottom-0 left-0 right-0 p-3 border-t border-slate-700 bg-slate-800">
    <div class="flex items-center p-2 rounded-lg hover:bg-slate-700 transition-colors cursor-pointer group">
      <div class="h-8 w-8 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center ring-2 ring-slate-700 group-hover:ring-slate-600">
        <span class="text-sm font-medium">JD</span>
      </div>
      <div x-show="sidebarOpen" class="ml-3">
        <p class="text-sm font-medium text-white">John Doe</p>
        <p class="text-xs text-slate-400">Administrator</p>
      </div>
      <i x-show="sidebarOpen" class="fas fa-chevron-down ml-auto text-slate-400 text-xs"></i>
    </div>
    
    <!-- Toggle Sidebar Button -->
    <button 
      @click="sidebarOpen = !sidebarOpen" 
      class="mt-2 p-2 w-full rounded-lg text-slate-400 hover:bg-slate-700 hover:text-white transition-colors text-center"
    >
      <i class="fas" :class="sidebarOpen ? 'fa-chevron-left' : 'fa-chevron-right'"></i>
      <span x-show="sidebarOpen" class="ml-2 text-sm">Collapse</span>
    </button>
  </div>
</aside>