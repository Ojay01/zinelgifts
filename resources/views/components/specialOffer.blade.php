<!-- resources/views/components/special-offer-banner.blade.php -->
@props([
    'backgroundImage' => 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
    'title' => 'Special  December Sale',
    'description' => 'Get up to 50% off on selected items',
    'endDate' => '2024-09-31 23:59:59'
])

<div class="relative dark:bg-black text-yellow-500 py-16 overflow-hidden" x-data="countdown('{{ $endDate }}')" x-init="init()">
    <div class="absolute inset-0 z-0">
        <img src="{{ $backgroundImage }}" alt="Special Offer Background" class="w-full h-full object-cover opacity-50">
        <div class="absolute inset-0 bg-black bg-opacity-75"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-8">
            <h2 class="text-4xl md:text-5xl font-bold mb-4">{{ $title }}</h2>
            <p class="text-xl md:text-2xl">{{ $description }}</p>
        </div>
        
        <div class="flex justify-center space-x-4 md:space-x-8 mb-8">
            <div class="text-center">
                <span x-text="days" class="text-3xl md:text-5xl font-bold block"></span>
                <span class="text-sm md:text-base">Days</span>
            </div>
            <div class="text-center">
                <span x-text="hours" class="text-3xl md:text-5xl font-bold block"></span>
                <span class="text-sm md:text-base">Hours</span>
            </div>
            <div class="text-center">
                <span x-text="minutes" class="text-3xl md:text-5xl font-bold block"></span>
                <span class="text-sm md:text-base">Minutes</span>
            </div>
            <div class="text-center">
                <span x-text="seconds" class="text-3xl md:text-5xl font-bold block"></span>
                <span class="text-sm md:text-base">Seconds</span>
            </div>
        </div>
        
        <div class="text-center">
            <a href="#" class="inline-block bg-yellow-500 text-black font-bold py-3 px-8 rounded-full hover:bg-yellow-400 transition duration-300">Shop Now</a>
        </div>
    </div>
</div>

<script>
function countdown(endDate) {
    return {
        days: '00',
        hours: '00',
        minutes: '00',
        seconds: '00',
        endTime: new Date(endDate).getTime(),
        now: new Date().getTime(),
        
        init() {
            setInterval(() => {
                this.now = new Date().getTime();
                const distance = this.endTime - this.now;
                
                if (distance > 0) {
                    this.days = Math.floor(distance / (1000 * 60 * 60 * 24)).toString().padStart(2, '0');
                    this.hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)).toString().padStart(2, '0');
                    this.minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)).toString().padStart(2, '0');
                    this.seconds = Math.floor((distance % (1000 * 60)) / 1000).toString().padStart(2, '0');
                }
            }, 1000);
        }
    };
}
</script>