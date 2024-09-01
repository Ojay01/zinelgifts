<!-- resources/views/components/hero-slider-black.blade.php -->
@php
$slides = [
    [
        'image' => 'https://cdn.pixabay.com/photo/2024/08/26/12/29/milky-way-8999255_1280.jpg',
        'subtitle' => 'HIGH STRENGTH AND DURABLE',
        'title' => 'Buy The Best Equipment For An Excellent Surprise.',
        'button1' => ['text' => 'VIEW MORE', 'link' => '#'],
        'button2' => ['text' => 'TO SHOP', 'link' => '#']
    ],
    [
        'image' => 'https://cdn.pixabay.com/photo/2023/10/07/14/24/smartwatch-8300238_1280.jpg',
        'subtitle' => 'QUALITY GUARANTEED',
        'title' => 'Discover Our Premium Selection',
        'button1' => ['text' => 'EXPLORE', 'link' => '#'],
        'button2' => ['text' => 'SHOP NOW', 'link' => '#']
    ],
    [
        'image' => 'https://cdn.pixabay.com/photo/2024/07/21/10/22/vulture-8910009_1280.jpg',
        'subtitle' => 'ADVENTURE AWAITS',
        'title' => 'Gear Up for Your Next Unforgettable Journey',
        'button1' => ['text' => 'LEARN MORE', 'link' => '#'],
        'button2' => ['text' => 'GET STARTED', 'link' => '#']
    ]
];
@endphp

<div class="relative w-full h-[600px] overflow-hidden" 
     x-data="{ 
        activeSlide: 1,
        slidesCount: {{ count($slides) }},
        autoSlide: null,
        startAutoSlide() {
            this.autoSlide = setInterval(() => {
                this.activeSlide = this.activeSlide === this.slidesCount ? 1 : this.activeSlide + 1;
            }, 5000);
        },
        stopAutoSlide() {
            if (this.autoSlide) {
                clearInterval(this.autoSlide);
            }
        }
     }"
     x-init="startAutoSlide()"
     @mouseenter="stopAutoSlide()"
     @mouseleave="startAutoSlide()"
>
    @foreach($slides as $index => $slide)
        <div
            class="absolute inset-0 transition-opacity duration-1000 ease-in-out"
            x-show="activeSlide === {{ $index + 1 }}"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        >
            <img
                src="{{ $slide['image'] }}"
                alt="Slide {{ $index + 1 }}"
                class="object-cover w-full h-full"
            >
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            <div class="absolute inset-0 flex flex-col items-center justify-center text-white p-4">
                <p class="text-yellow-500 text-xl mb-4">{{ $slide['subtitle'] }}</p>
                <h2 class="text-4xl md:text-5xl font-bold text-center max-w-3xl leading-tight mb-8">
                    {{ $slide['title'] }}
                </h2>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ $slide['button1']['link'] }}" class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-2 px-6 rounded">
                        {{ $slide['button1']['text'] }}
                    </a>
                    <a href="{{ $slide['button2']['link'] }}" class="bg-transparent hover:bg-gray-800 text-yellow-500 font-bold py-2 px-6 rounded border border-yellow-500">
                        {{ $slide['button2']['text'] }}
                    </a>
                </div>
            </div>
        </div>
    @endforeach

    <div class="absolute bottom-5 left-1/2 transform -translate-x-1/2 flex space-x-2">
        @foreach($slides as $index => $slide)
            <button
                class="w-3 h-3 rounded-full transition-all duration-300 ease-in-out"
                :class="{ 'bg-yellow-500': activeSlide === {{ $index + 1 }}, 'bg-gray-400': activeSlide !== {{ $index + 1 }} }"
                @click="activeSlide = {{ $index + 1 }}"
            ></button>
        @endforeach
    </div>

    <button
        class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-yellow-500 p-2 rounded-full hover:bg-opacity-75"
        @click="activeSlide = activeSlide === 1 ? slidesCount : activeSlide - 1"
    >
    <i class="fas fa-chevron-left text-xl"></i>
    </button>
    <button
        class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-yellow-500 p-2 rounded-full hover:bg-opacity-75"
        @click="activeSlide = activeSlide === slidesCount ? 1 : activeSlide + 1"
    >
    <i class="fas fa-chevron-right text-xl"></i>
    </button>
</div>