<!-- resources/views/team.blade.php -->
<x-guest-layout>
    <x-header />

    <!-- Hero Section -->
    <div class="relative bg-gray-900 py-24">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'); opacity: 0.4;"></div>
        <div class="relative container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 text-white dark:text-yellow-500">Our Team</h1>
            <div class="w-24 h-1 bg-yellow-500 mx-auto mb-8"></div>
            <p class="text-xl max-w-3xl mx-auto text-white/80">
                We are made up of specially selected top-class personnel & artists who are experienced in the field of gift customizations and crafting from around the globe, as well as top quality print houses across the world. This ensures that every job is handled with 100% professionalism and skill. Above all, we strive to remain at the top of our game at every point in time.
            </p>
        </div>
    </div>
    @php
    $team_members = [
        ['name' => 'PHARMAX', 'role' => 'Official Sponsor & Developer', 'bio' => ''],
        ['name' => 'FEKA LEONEL', 'role' => 'CEO of ZINEL, Graphics Designer', 'bio' => 'I am a creative designer specializing in design for print & digital, branding & web. I am currently based in Cameroon with over 10 years experience in the design industry with a passion for sharing knowledge and teaching as well as bringing the best of customized gift products/ideas to the world at large. I have created this platform to share my experience and give each and every one the opportunity to make their loved ones smile at all times through the sharing of unique and custom branded gift products.'],
        ['name' => 'NZOYIM GIRESS', 'role' => 'Co-founder, Graphics Designer', 'bio' => 'I am a creative designer specializing in design for print & digital, branding & web. I am currently based in Cameroon with over 5 years experience in the design industry. When it comes to design and Print I am here to offer just the best. Having a mastery in the operation of a variety of printing machines, your finished Print product quality is Guaranteed.'],
        ['name' => 'NSALI ZITA', 'role' => 'Marketing Manager, Graphics Designer', 'bio' => 'I am an adventurous multicultural designer who is a positive thinker and likes to challenge myself creatively. Having been trained in the field of graphics for two years and also an experienced Marketer, I carry my job with passion and commitment. Above all I love to put a smile on people\'s faces by doing what I love best.'],
        ['name' => 'ISABELLE NGISSAH', 'role' => 'Marketer, Graphics Designer', 'bio' => 'I am a marketing and small-business growth expert specializing in value and experience driven businesses. After 5 years working as a designer, Printer and Marketing consultant, I am setting up and managing our campaigns, making sure that people who we can help the most will find us. Outside of work, I enjoy quality time with friends and family.'],
        ['name' => 'NDE MORIS', 'role' => 'Graphics Designer', 'bio' => 'I am a certified graphic designer and I earned my bachelor\'s degree in Communication Design. I work with many companies and offer quality work at the best price. Not only that, but I provide the highest quality services and my purpose is to provide quality graphic design services that you will need to complete your projects. My expertise is in completing all types of work that are related to graphic design. Whether that work is brand identity design, packaging design, photo-editing, or anything else I can do efficiently.'],
        ['name' => 'KEPE EDDY', 'role' => 'Technician & Logistician', 'bio' => 'I am a full-time Graphics technician and my passion is to Produce Hand Crafted Arts Works with 100% unique design, high quality, and amazing service. I am an experienced arts Engineer and have worked for more than 5 years in the technical Department. Also, when it comes to transportation and delivery of Your Orders and finished products, consider it done on time because I\'ll always be there to make sure.']
    ];
    @endphp

 <!-- Team Members -->
<div class="bg-gray-100 dark:bg-gray-800 py-32">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-20">
            @foreach($team_members as $member)
            <div class="relative">
                <!-- Card with Visible Cutout -->
                <div class="bg-white dark:bg-gray-700 rounded-lg shadow-lg overflow-hidden pt-20">
                    <!-- Cutout for Image -->
                    <div class="absolute -top-16 left-1/2 transform -translate-x-1/2 w-36 h-36 bg-gray-100 dark:bg-gray-800 rounded-full"></div>
                    
                    <!-- Floating Image -->
                    <div class="absolute -top-16 left-1/2 transform -translate-x-1/2 w-32 h-32">
                        <div class="w-full h-full rounded-full overflow-hidden border-4 border-white dark:border-gray-700 shadow-lg transition-all duration-300 hover:scale-110">
                            <img src="https://via.placeholder.com/128x128.png?text={{ str_replace(' ', '+', $member['name']) }}" alt="{{ $member['name'] }}" class="w-full h-full object-cover">
                        </div>
                    </div>
                    
                    <!-- Card Content -->
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-yellow-500 mb-2 text-center">{{ $member['name'] }}</h3>
                        <p class="text-sm text-yellow-600 dark:text-yellow-400 mb-4 text-center">{{ $member['role'] }}</p>
                        <div class="relative">
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 bio-short">{{ Str::limit($member['bio'], 100) }}</p>
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 bio-full hidden">{{ $member['bio'] }}</p>
                            @if (strlen($member['bio']) > 100)
                            <button class="text-yellow-500 hover:text-yellow-600 text-sm font-semibold focus:outline-none read-more-btn" onclick="toggleBio(this)">
                                Read More
                            </button>
                            @endif
                        </div>
                        
                        <!-- Social Icons -->
                        <div class="flex justify-center space-x-4 mt-4">
                            <a href="#" class="text-blue-500 hover:text-blue-600 transition-colors duration-300">
                                <i class="fab fa-facebook-f"></i>

                            </a>
                            <a href="#" class="text-pink-500 hover:text-pink-600 transition-colors duration-300">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    function toggleBio(button) {
        const card = button.closest('.bg-white, .dark\\:bg-gray-700');
        const shortBio = card.querySelector('.bio-short');
        const fullBio = card.querySelector('.bio-full');
        
        if (fullBio.classList.contains('hidden')) {
            shortBio.classList.add('hidden');
            fullBio.classList.remove('hidden');
            button.textContent = 'Read Less';
        } else {
            fullBio.classList.add('hidden');
            shortBio.classList.remove('hidden');
            button.textContent = 'Read More';
        }
    }
</script>

    <x-footer />

</x-guest-layout>