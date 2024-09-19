<div class="relative w-full overflow-hidden" 
     x-data="{ 
        activeSlide: 1,
        slidesCount: {{ count($slides) }},
        autoSlide: null,
        sliding: false,
        startAutoSlide() {
            this.autoSlide = setInterval(() => {
                this.nextSlide();
            }, 5000);
        },
        stopAutoSlide() {
            if (this.autoSlide) {
                clearInterval(this.autoSlide);
            }
        },
        nextSlide() {
            if (!this.sliding) {
                this.sliding = true;
                this.activeSlide = this.activeSlide === this.slidesCount ? 1 : this.activeSlide + 1;
                setTimeout(() => { this.sliding = false; }, 600);
            }
        },
        prevSlide() {
            if (!this.sliding) {
                this.sliding = true;
                this.activeSlide = this.activeSlide === 1 ? this.slidesCount : this.activeSlide - 1;
                setTimeout(() => { this.sliding = false; }, 600);
            }
        }
     }"
     x-init="startAutoSlide()"
     @mouseenter="stopAutoSlide()"
     @mouseleave="startAutoSlide()"
>
    <!-- Slider Container with dynamic translation -->
    <div class="flex transition-transform duration-500 ease-in-out" 
         :style="'transform: translateX(-' + (activeSlide - 1) * 100 + '%)'">
        @foreach($slides as $index => $slide)
            <div class="w-full flex-shrink-0 min-w-full relative">
                <!-- Responsive Image for Small Screens -->
                <img
                    src="{{ $slide->image_small }}"
                    alt="Slide {{ $index + 1 }}"
                    class="w-full lg:hidden"
                />
                <!-- Responsive Image for Large Screens -->
                <img
                    src="{{ $slide->image }}"
                    alt="Slide {{ $index + 1 }}"
                    class="w-full hidden lg:block"
                />
                
                <!-- Overlay and Text Content -->
                <div class="absolute inset-0 dark:bg-black/50"></div>
                <div class="absolute inset-0 mt-8 flex flex-col items-center lg:justify-center text-white p-4 lg:pr-80">
                    <h2 class="text-yellow-500 text-xl text-center">
                        {!! $slide->title !!}
                    </h2>
                    @if (!is_null($slide->subtitle))
                        <p class="text-yellow-500 mb-4 mx-auto">
                            {!! $slide->subtitle !!}
                        </p>
                    @endif
                    
                    @if (!is_null($slide->button1_text))
                    <div class="flex items-center justify-center mt-2 w-full ">
                        <a href="{{ $slide->button1_link }}" class="bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-3 px-8 rounded-full transition duration-300 ease-in-out">
                            {{ $slide->button1_text }}
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <!-- Slide Indicators -->
    <div class="absolute bottom-5 left-1/2 transform -translate-x-1/2 flex space-x-2">
        @foreach($slides as $index => $slide)
            <button
                class="w-3 h-3 rounded-full transition-all duration-300 ease-in-out"
                :class="{ 'bg-yellow-500': activeSlide === {{ $index + 1 }}, 'bg-gray-400': activeSlide !== {{ $index + 1 }} }"
                @click="activeSlide = {{ $index + 1 }}"
            ></button>
        @endforeach
    </div>

    <!-- Navigation Arrows -->
    <button
        class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-yellow-500 p-2 rounded-full hover:bg-opacity-75"
        @click="prevSlide()"
    >
        <i class="fas fa-chevron-left text-xl"></i>
    </button>
    <button
        class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-yellow-500 p-2 rounded-full hover:bg-opacity-75"
        @click="nextSlide()"
    >
        <i class="fas fa-chevron-right text-xl"></i>
    </button>
</div>
