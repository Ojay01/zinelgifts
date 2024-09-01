<!-- resources/views/components/partners-section.blade.php -->
@props(['partners' => [
    ['name' => 'IKEA', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/c/c5/Ikea_logo.svg'],
    ['name' => 'Herman Miller', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/3/3f/Herman_Miller_logo.svg'],
    ['name' => 'Wayfair', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/c/c5/Ikea_logo.svg'],
    ['name' => 'West Elm', 'logo' => 'https://upload.wikimedia.org/wikipedia/commons/c/c5/Ikea_logo.svg'],
]])

<section class="bg-gray-100 py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-black mb-2">OUR PARTNERS</h2>
        <div class="w-20 h-1 bg-yellow-500 mx-auto mb-12"></div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 items-center">
            @foreach($partners as $partner)
                <div class="flex justify-center items-center p-4 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    <img src="{{ $partner['logo'] }}" alt="{{ $partner['name'] }}" class="max-h-16 max-w-full object-contain filter grayscale hover:grayscale-0 transition-all duration-300">
                </div>
            @endforeach
        </div>
    </div>
</section>