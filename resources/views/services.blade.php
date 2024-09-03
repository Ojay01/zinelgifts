<!-- resources/views/services.blade.php -->
<x-guest-layout>
    <x-header />

    <div class="bg-gray-100 dark:bg-gray-900 py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold text-center text-gray-800 dark:text-yellow-500 mb-4">Our Services</h1>
            <div class="w-24 h-1 bg-yellow-500 mx-auto mb-12"></div>

            <!-- Event Planning & Décor Services -->
            <section class="mb-20">
                <h2 class="text-3xl font-semibold text-gray-800 dark:text-yellow-500 mb-8">Event Planning & Décor Services</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ([
                        'Birthday celebrations' => 'https://images.unsplash.com/photo-1464349153735-7db50ed83c84',
                        'Anniversary Celebrations' => 'https://images.unsplash.com/photo-1519741497674-611481863552',
                        'Reunions' => 'https://images.unsplash.com/photo-1529333166437-7750a6dd5a70',
                        'Parties' => 'https://images.unsplash.com/photo-1496843916299-590492c751f4',
                        'Engagement Parties' => 'https://images.unsplash.com/photo-1464349153735-7db50ed83c84'
                    ] as $service => $imageUrl)
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                            <img src="{{ $imageUrl }}" alt="{{ $service }}" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold text-gray-800 dark:text-yellow-500">{{ $service }}</h3>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <!-- Graphic Design, Branding & Printing Services -->
            <section>
                <h2 class="text-3xl font-semibold text-gray-800 dark:text-yellow-500 mb-8">Graphic Design, Branding & Printing Services</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ([
                        'Logos' => 'https://images.unsplash.com/photo-1464349153735-7db50ed83c84',
                        'Flyers' => 'https://images.unsplash.com/photo-1464349153735-7db50ed83c84',
                        'Posters' => 'https://images.unsplash.com/photo-1587614381634-068e97d007ad',
                        'Banners' => 'https://images.unsplash.com/photo-1464349153735-7db50ed83c84',
                        'Sticker Posters' => 'https://images.unsplash.com/photo-1464349153735-7db50ed83c84',
                        'Billboards' => 'https://images.unsplash.com/photo-1464349153735-7db50ed83c84'
                    ] as $service => $imageUrl)
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                            <img src="{{ $imageUrl }}" alt="{{ $service }}" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold text-gray-800 dark:text-yellow-500">{{ $service }}</h3>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>

    <x-footer />
</x-guest-layout>