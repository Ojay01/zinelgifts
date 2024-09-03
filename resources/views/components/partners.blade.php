<!-- resources/views/components/partners-section.blade.php -->
@props(['partners' => [
    ['name' => 'IKEA', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/c/c5/Ikea_logo.svg'],
    ['name' => 'Herman Miller', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/3/3f/Herman_Miller_logo.svg'],
    ['name' => 'Wayfair', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/c/c5/Ikea_logo.svg'],
    ['name' => 'West Elm', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/c/c5/Ikea_logo.svg'],
]])

<section class="bg-gray-100 dark:bg-gray-900 py-16 transition-colors duration-300">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-gray-800 dark:text-yellow-500 mb-2 transition-colors duration-300">OUR PARTNERS</h2>
        <div class="w-20 h-1 bg-yellow-500 mx-auto mb-12"></div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 items-center">
            @foreach($partners as $partner)
                <div class="group flex justify-center items-center p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <img 
                        src="{{ $partner['logo'] }}" 
                        alt="{{ $partner['name'] }}" 
                        class="max-h-16 max-w-full object-contain transition-all duration-300 group-hover:scale-110 filter dark:invert group-hover:filter-none"
                    >
                </div>
            @endforeach
        </div>
    </div>
</section>