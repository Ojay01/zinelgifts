<header class="fixed top-0 right-0 z-20 w-full bg-slate-800/95 border-b border-slate-700 backdrop-blur-sm">
    <div :class="{'md:ml-64': sidebarOpen, 'md:ml-20': !sidebarOpen}"
         class="flex items-center justify-between h-16 px-4 transition-all duration-300">
        <div class="flex items-center gap-4 z-30">
            <button 
                data-menu-toggle
                @click="mobileMenuOpen = !mobileMenuOpen"
                class="md:hidden p-2 rounded-lg hover:bg-slate-700 transition-colors"
            >
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <button 
                @click="sidebarOpen = !sidebarOpen"
                class="hidden md:block p-2 z-30 rounded-lg hover:bg-slate-700 transition-colors group"
            >
                <svg class="h-6 w-6 transition-transform duration-200" 
                     :class="{'rotate-180': !sidebarOpen}"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
            
        </div>
        
        <div class="flex items-center gap-2 md:gap-4">
            <!-- Theme Toggle with Animation -->
  
            
            <!-- Enhanced Notifications -->
            <div class="relative" x-data="{ open: false }" @click.away="open = false">
                <button 
                    @click="open = !open"
                    class="p-2 rounded-lg hover:bg-slate-700 transition-colors relative"
                >
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    <span 
                        x-show="notifications.filter(n => n.unread).length > 0"
                        class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full animate-pulse"
                    ></span>
                </button>
                
                <!-- Enhanced Notifications Dropdown -->
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 translate-y-1"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="absolute right-0 mt-2 w-72 bg-slate-800 rounded-lg shadow-lg border border-slate-700 overflow-hidden">
                    <div class="p-2">
                        <div class="flex items-center justify-between px-3 py-2">
                            <h3 class="font-semibold">Notifications</h3>
                            <button class="text-sm text-blue-400 hover:text-blue-300 transition-colors">
                                Mark all as read
                            </button>
                        </div>
                        <div class="mt-2 space-y-1">
                         
                        </div>
                        <div class="mt-2 pt-2 border-t border-slate-700">
                            <button class="w-full text-center text-sm text-blue-400 hover:text-blue-300 py-1 transition-colors">
                                View all notifications
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
           <!-- Enhanced User Menu -->
           <div class="relative" x-data="{ open: false }" @click.away="open = false">
            <button 
                @click="open = !open"
                class="flex items-center gap-2 p-1.5 rounded-lg hover:bg-slate-700 transition-colors group"
            >
                <div class="h-8 w-8 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center ring-2 ring-slate-700 group-hover:ring-slate-600 transition-all">
                    <span class="text-sm font-medium">JD</span>
                </div>
                <div class="hidden md:block">
                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
            </button>
            
            <!-- Enhanced User Dropdown -->
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-1"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="absolute right-0 mt-2 w-64 bg-slate-800 rounded-lg shadow-lg border border-slate-700 overflow-hidden">
                <div class="p-4 border-b border-slate-700">
                    <div class="flex items-center gap-3">
                        <div class="h-12 w-12 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                            <span class="text-lg font-medium">JD</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-sm font-medium truncate">John Doe</h3>
                            <p class="text-xs text-slate-400 truncate">john.doe@example.com</p>
                            <span class="inline-flex items-center mt-1 px-2 py-0.5 rounded-full text-xs font-medium bg-blue-500/10 text-blue-400">
                                Admin
                            </span>
                        </div>
                    </div>
                </div>
                <div class="p-2">
                    <div class="space-y-1">
                        <button class="w-full flex items-center gap-3 text-left px-3 py-2 hover:bg-slate-700 rounded-lg transition-colors group">
                            <svg class="h-5 w-5 text-slate-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>Profile</span>
                        </button>
                        <button class="w-full flex items-center gap-3 text-left px-3 py-2 hover:bg-slate-700 rounded-lg transition-colors group">
                            <svg class="h-5 w-5 text-slate-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Settings</span>
                        </button>
                        <button class="w-full flex items-center gap-3 text-left px-3 py-2 hover:bg-slate-700 rounded-lg transition-colors group">
                            <svg class="h-5 w-5 text-slate-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Help & Support</span>
                        </button>
                    </div>
                    <div class="mt-2 pt-2 border-t border-slate-700">
                        <button class="w-full flex items-center gap-3 text-left px-3 py-2 text-red-400 hover:bg-red-500/10 rounded-lg transition-colors group">
                            <svg class="h-5 w-5 group-hover:text-red-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span>Sign Out</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</header>