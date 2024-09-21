<!-- resources/views/components/partners-section.blade.php -->
@props(['partners' => [
    ['name' => 'Decor Villa', 'logo' => '/img/partners/1.jpg'],
    ['name' => 'Zmile', 'logo' => '/img/partners/2.jpg'],
    ['name' => 'Hono Dream Cakes', 'logo' => '/img/partners/3.jpg'],
    ['name' => 'Bella\'s Cake', 'logo' => '/img/partners/4.jpg'],
    ['name' => 'Galaxe', 'logo' => '/img/partners/5.jpg'],
]])

<section class="bg-gradient-to-b from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 py-20 transition-colors duration-300">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center text-gray-800 dark:text-yellow-500 mb-4 transition-colors duration-300">Our Partners</h2>
        <p class="text-center text-gray-600 dark:text-gray-400 mb-12 max-w-2xl mx-auto">We're proud to collaborate with these amazing brands to bring you the best products and services.</p>
        
        <div class="relative overflow-hidden w-full" style="height: 150px;">
            <div class="absolute inset-0 flex items-center">
                <!-- The animation container -->
                <div class="animate-scroll flex items-center">
                    @foreach($partners as $partner)
                        <div class="group relative flex-shrink-0 mx-6">
                            <div class="absolute inset-0 bg-yellow-500 rounded-xl opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                            <img 
                                src="{{ $partner['logo'] }}" 
                                alt="{{ $partner['name'] }}" 
                                class="h-20 md:h-24 w-auto object-contain transition-all duration-300 group-hover:scale-110 filter hover:grayscale-0 rounded-xl"
                            >
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <span class="text-sm font-semibold text-gray-800 dark:text-yellow-500 bg-white dark:bg-gray-900 px-2 py-1 rounded-full shadow-md">{{ $partner['name'] }}</span>
                            </div>
                        </div>
                    @endforeach

                    <!-- Duplicate the items to create the seamless effect -->
                    @foreach($partners as $partner)
                        <div class="group relative flex-shrink-0 mx-6">
                            <div class="absolute inset-0 bg-yellow-500 rounded-xl opacity-0 group-hover:opacity-10 transition-opacity duration-200"></div>
                            <img 
                                src="{{ $partner['logo'] }}" 
                                alt="{{ $partner['name'] }}" 
                                class="max-h-20 md:max-h-24 w-auto object-contain transition-all duration-200 group-hover:scale-110 filter hover:grayscale-0 rounded-xl"
                            >
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <span class="text-sm font-semibold text-gray-800 dark:text-yellow-500 bg-white dark:bg-gray-900 px-2 py-1 rounded-full shadow-md">{{ $partner['name'] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<style>
@keyframes scroll {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-60%);
    }
}

.animate-scroll {
    animation: scroll 10s linear infinite; 
    display: flex;
    width: max-content;
}

.animate-scroll:hover {
    animation-play-state: paused;
}
</style>
