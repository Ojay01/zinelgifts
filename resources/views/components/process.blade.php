<!-- resources/views/components/process-section.blade.php -->
@props(['steps' => [
    ['number' => '1', 'title' => 'Home Delivery.', 'description' => 'Everywhere in Cameroon'],
    ['number' => '2', 'title' => 'Order As a Gift.', 'description' => 'Surprise your loved ones.'],
    ['number' => '3', 'title' => 'High Quality.', 'description' => 'Get what you ordered.'],
    ['number' => '4', 'title' => 'Buy With Joy.', 'description' => 'Satisfaction is guaranteed'],
]])

<section class="bg-gray-100 dark:bg-gray-900 dark:text-yellow-500 py-20">
    <div class="container mx-auto px-4 flex justify-center">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($steps as $step)
            <div class="flex flex-col sm:flex-row items-center md:items-start text-center md:text-left">
                <!-- Number Column -->
                <span class="text-5xl font-bold hover:text-yellow-500 dark:text-yellow-500 mb-4 md:mb-0 md:mr-4">{{ $step['number'] }}.</span>
                <!-- Text Column -->
                <div class="flex flex-col items-center md:items-start">
                    <h3 class="text-3xl lg:text-xl xl:text-3xl font-semibold hover:text-yellow-500 dark:text-yellow-500 mb-2">{{ $step['title'] }}</h3>
                    <p class="text-md xl:text-lg hover:text-yellow-500 dark:text-yellow-400/70">{{ $step['description'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
