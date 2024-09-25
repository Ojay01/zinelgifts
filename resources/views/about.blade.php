<!-- resources/views/about-us.blade.php -->
<x-guest-layout>
    <x-header />
    <!-- Hero Section with Parallax Effect -->
    <div class="relative min-h-[20vh] sm:min-h-[25vh] md:min-h-[35vh] overflow-hidden">
        <div class="absolute inset-0">
            <img src="/img/abt.jpg" alt="About Zinel Gifts" class="w-full h-full object-cover transform scale-110 motion-safe:animate-slow-zoom">
            <div class="absolute inset-0 dark:bg-black opacity-50"></div>
        </div>
        <div class="absolute inset-0 flex flex-col items-center justify-center">
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold text-white dark:text-yellow-500 text-center px-4 motion-safe:animate-fade-in-up mb-4">About Zinel Gifts</h1>
            <div class="w-24 h-1 bg-yellow-500 mx-auto "></div>
        </div>
    </div>

    <div class="bg-gray-100 dark:bg-gray-900 transition-colors duration-300">
        <div class="container mx-auto px-4 py-16 max-w-4xl">
            <!-- Main Content -->
            <div class="mb-16 text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-yellow-500 mb-4">Our Story</h2>
                <div class="w-24 h-1 bg-yellow-500 mx-auto mb-8"></div>
                <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed">
                    ZINEL is a gift shop created to help every individual easily get perfectly customized/personalized gift products every time, and anywhere for any occasion or ceremony. From birthdays and anniversaries to holiday gifts, we're your number one gifting destination. This is where you will find one-of-a-kind gifts as unique and special as the people you are celebrating.
                </p>
            </div>

            <!-- Vision and Mission -->
            <div class="grid md:grid-cols-2 gap-8 mb-16">
                <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg transform transition duration-300 hover:scale-105">
                    <h3 class="text-2xl font-bold text-yellow-500 mb-4">Our Vision</h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        We aim to become the leading gift brand in Cameroon and one of the top 10 gift shops in Africa within our first decade. Our goal is to help every individual find the perfect, customized gift for their loved ones, making every occasion truly special.
                    </p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg transform transition duration-300 hover:scale-105">
                    <h3 class="text-2xl font-bold text-yellow-500 mb-4">Our Mission</h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        To be the most trusted gift shop, ensuring customer satisfaction at every interaction. We commit to sustainability, community participation, and maintaining the highest standards in meeting our clients' needs precisely and completely.
                    </p>
                </div>
            </div>

            <!-- Key Points -->
 <!-- Key Points -->
<div class="space-y-8">
    <h3 class="text-3xl font-bold text-center text-gray-800 dark:text-yellow-500 mb-4">Why Choose Zinel?</h3>
    <div class="w-24 h-1 bg-yellow-500 mx-auto mb-8"></div>
    <div class="grid md:grid-cols-2 gap-6">
        <?php
        $points = [
            ['icon' => 'fa-gift', 'title' => 'Extensive Selection', 'description' => 'Over 1000 customizable gift products for all occasions.'],
            ['icon' => 'fa-heart', 'title' => 'Customer Satisfaction', 'description' => 'Your happiness is our top priority.'],
            ['icon' => 'fa-headset', 'title' => 'Excellent Support', 'description' => 'From advice to assistance, we\'re here to help.'],
            ['icon' => 'fa-truck', 'title' => 'Fast Delivery', 'description' => 'Quicker, easier, and more affordable shipping.'],
            ['icon' => 'fa-comments', 'title' => 'Live Chat', 'description' => 'Instant support for all your questions.'],
            ['icon' => 'fa-plus-circle', 'title' => 'Additional Services', 'description' => 'Event planning, design, printing, and branding.']
        ];
        
        foreach ($points as $point):
        ?>
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <i class="fas <?php echo $point['icon']; ?> text-3xl text-yellow-500"></i>
                </div>
                <div>
                    <h4 class="text-xl font-semibold text-gray-800 dark:text-yellow-400 mb-2"><?php echo $point['title']; ?></h4>
                    <p class="text-gray-600 dark:text-gray-300"><?php echo $point['description']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
        </div>
    </div>

    <x-footer />
</x-guest-layout>

<style>
    @keyframes slow-zoom {
        0% { transform: scale(1); }
        100% { transform: scale(1.1); }
    }
    @keyframes fade-in-up {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .animate-slow-zoom {
        animation: slow-zoom 20s ease-in-out infinite alternate;
    }
    .animate-fade-in-up {
        animation: fade-in-up 1s ease-out;
    }
</style>