<!-- In profile/show.blade.php -->

<nav class="space-y-2">
    @php
        $navigationItems = [
            [
                'route' => 'profile.information',
                'url' => route('profile.information'),
                'icon' => 'fa-user-circle',
                'text' => 'Profile Information'
            ],
            [
                'route' => 'profile.orders',
                'url' => route('profile.orders'),
                'icon' => 'fa-shopping-bag',
                'text' => 'Order History'
            ],
            [
                'route' => 'profile.wishlist',
                'url' => route('profile.wishlist'),
                'icon' => 'fa-heart',
                'text' => 'Wishlist'
            ],
            [
                'route' => 'profile.addresses',
                'url' => route('profile.addresses'),
                'icon' => 'fa-map-marker-alt',
                'text' => 'Addresses'
            ],
            [
                'route' => 'profile.settings',
                'url' => route('profile.settings'),
                'icon' => 'fa-cog',
                'text' => 'Settings'
            ]
        ];
    @endphp

    {{-- @foreach($navigationItems as $item)
        <a href="{{ $item['url'] }}" 
           class="flex items-center space-x-2 p-3 rounded-lg {{ request()->routeIs($item['route']) ? 'bg-yellow-500 text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-yellow-50 dark:hover:bg-gray-700' }}">
            <i class="fas {{ $item['icon'] }}"></i>
            <span>{{ $item['text'] }}</span>
        </a>
    @endforeach --}}
</nav>