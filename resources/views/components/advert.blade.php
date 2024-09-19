<section class="bg-white dark:bg-gray-800 py-16 transition-colors duration-300" id="animated-section">
    <div class="container mx-auto px-4">
    <!-- Row 1: Two product cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
      <div class="relative rounded-lg overflow-hidden shadow h-64 animate-item">
        <img src="advert1.jpg" alt="Amazfit Bio Pro" class="w-full h-full object-cover" />
        <div class="absolute inset-0 dark:bg-black/30 p-10 flex flex-col justify-center">
          <h2 class="text-xl uppercase font-black mb-2 text-white animate-h2"> <span class='text-yellow-500'>CUSTOMIZE </span> YOUR MUGS</h2>
          <p class="mb-4 text-white/90 max-w-64 animate-p">To use as souvenirs for your special 
            occasions and anniversaries</p>
          <button class="bg-white text-purple-600 px-4 py-2 rounded-full w-fit animate-button">ORDER NOW</button>
        </div>
      </div>
      
      <div class="relative rounded-lg overflow-hidden shadow h-64 animate-item">
        <img src="advert2.jpg" alt="Samsung Galaxy Smartwatch" class="w-full h-full object-cover" />
        <div class="absolute inset-0 dark:bg-black/30 p-10 flex flex-col justify-center">
          <h2 class="text-2xl uppercase font-black mb-2 text-white animate-h2">GET <span class='text-yellow-500'>PERSONALISED </span> T-SHIRTS </h2>
          <p class="mb-2 text-white/90 max-w-72 animate-p">For kids Birthday Parties & Events printing at affordable prices with free</p>
          <button class="bg-white text-blue-600 px-4 py-2 rounded-full w-fit animate-button">ORDER NOW</button>
        </div>
      </div>
    </div>
    
    <div class="relative rounded-lg overflow-hidden shadow h-64 animate-item">
      <img src="advert3.jpg" alt="Aspire Pavilion Laptop" class="w-full h-full object-cover" />
      <div class="absolute inset-0 dark:bg-black/30 p-10 flex flex-col justify-center">
        <h2 class="text-xl uppercase font-black mb-2 text-white animate-h2"> <span class='text-yellow-500'>LUXURY </span> WRIST WATCHES FOR HIM/HER</h2>
        <p class="mb-4 text-white/90 max-w-64 animate-p">Customized with your names engraved inside.</p>
        <button class="bg-white px-4 py-2 rounded-full w-fit animate-button">ORDER NOW</button>
      </div>
    </div>
    </div>
</section>

<style>
@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(30px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes scaleIn {
    0% {
        opacity: 0;
        transform: scale(0.95);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}

.animate-item {
    opacity: 0;
    transform: scale(0.95);
    transition: opacity 0.8s ease, transform 0.8s ease;
}

.animate-item.in-view {
    opacity: 1;
    transform: scale(1);
}

.animate-h2, .animate-p, .animate-button {
    opacity: 0;
    transform: translateY(30px);
    transition: opacity 0.8s ease, transform 0.8s ease;
}

.in-view .animate-h2.animated,
.in-view .animate-p.animated,
.in-view .animate-button.animated {
    opacity: 1;
    transform: translateY(0);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('in-view');
                animateContent(entry.target);
            } else {
                entry.target.classList.remove('in-view');
                resetAnimations(entry.target);
            }
        });
    }, observerOptions);

    const animatedItems = document.querySelectorAll('.animate-item');
    animatedItems.forEach(item => observer.observe(item));

    function animateContent(item) {
        const h2 = item.querySelector('.animate-h2');
        const p = item.querySelector('.animate-p');
        const button = item.querySelector('.animate-button');
        
        setTimeout(() => h2.classList.add('animated'), 200);
        setTimeout(() => p.classList.add('animated'), 400);
        setTimeout(() => button.classList.add('animated'), 600);
    }

    function resetAnimations(item) {
        const elements = item.querySelectorAll('.animate-h2, .animate-p, .animate-button');
        elements.forEach(el => el.classList.remove('animated'));
    }
});
</script>