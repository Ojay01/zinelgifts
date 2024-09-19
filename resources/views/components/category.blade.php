
<section id="category-section" class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 py-24 transition-all duration-500">
    <div class="container mx-auto px-4">
        <h2 class="md:text-6xl text-4xl font-black text-center text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600 mb-6 transform translate-y-0 transition-all duration-1000" id="category-title">TOP CATEGORIES</h2>
        <div class="w-40 h-2 bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600 mx-auto mb-20 rounded-full transform scale-x-100 transition-all duration-1000" id="category-underline"></div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12">
            @foreach($categories as $index => $category)
            <a href="{{ $category['link'] }}" class="group perspective" id="category-card-{{ $index }}">
                <div class="bg-gradient-to-br from-gray-800 to-gray-900 rounded-3xl overflow-hidden shadow-2xl lg:hover:shadow-yellow-500/20 transition-all duration-500 lg:transform lg:hover:scale-105 h-[400px]">
                    <div class="relative h-3/4 overflow-hidden">
                        <img 
                            src="{{ $category['image'] }}" 
                            alt="{{ $category['name'] }}" 
                            class="w-full h-full object-cover transition-transform duration-700 lg:group-hover:scale-110 lg:group-hover:rotate-3"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/70 to-transparent opacity-90 lg:group-hover:opacity-70 transition-opacity duration-500"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-8 transform lg:group-hover:-translate-y-2 transition-transform duration-500">
                            <h3 class="text-yellow-400 text-3xl font-bold mb-3">{{ $category['name'] }}</h3>
                            <p class="text-gray-300 text-lg font-medium lg:opacity-0 lg:group-hover:opacity-100 transition-all duration-500 delay-100">
                                {{ $category['description'] }}
                            </p>
                        </div>
                    </div>
                    <div class="h-1/4 flex items-center justify-between px-8 bg-gradient-to-r from-yellow-400 to-yellow-600 text-gray-900">
                        <span class="text-xl font-bold">{{ $category['products'] }} items</span>
                        <span class="lg:group-hover:translate-x-2 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    const title = document.getElementById('category-title');
    const underline = document.getElementById('category-underline');
    const cards = document.querySelectorAll('[id^="category-card-"]');

    observer.observe(title);
    observer.observe(underline);
    cards.forEach(card => observer.observe(card));
});
</script>

<style>
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes scaleIn {
    from {
        transform: scaleX(0);
    }
    to {
        transform: scaleX(1);
    }
}

.animate-in {
    animation: fadeInUp 0.6s ease-out forwards;
}

#category-title.animate-in {
    animation: fadeInUp 0.8s ease-out forwards;
}

#category-underline.animate-in {
    animation: scaleIn 0.8s ease-out forwards;
}

.perspective {
    perspective: 1000px;
}

[id^="category-card-"] {
    opacity: 1;
    transform: translateY(0);
    transition: opacity 0.6s ease-out, transform 0.6s ease-out;
}

[id^="category-card-"].animate-in {
    animation: fadeInUp 0.6s ease-out forwards;
}

[id^="category-card-"]:nth-child(1) { transition-delay: 0.1s; }
[id^="category-card-"]:nth-child(2) { transition-delay: 0.2s; }
[id^="category-card-"]:nth-child(3) { transition-delay: 0.3s; }
[id^="category-card-"]:nth-child(4) { transition-delay: 0.4s; }
</style>