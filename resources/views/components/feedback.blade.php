<!-- resources/views/components/feedback-section.blade.php -->

@props(['feedbacks' => [
    [
        'name' => 'Karen Bih',
        'avatar' => '/img/feedback/user1.jpg',
        'rating' => 5,
        'comment' => 'Service easily one of the best I have dealt with, no problems whatsoever, everything was so easy right from ordering to delivery.',
        'date' => '2024-09-10',
    ],
    [
        'name' => 'Jane Efillo',
        'avatar' => '/img/feedback/user2.jpg',
        'rating' => 4,
        'comment' => 'All good ordered were of good quality and arrived promptly. You are the BEST indeed.',
        'date' => '2024-08-10',
    ],
    [
        'name' => 'Mike Ettah',
        'avatar' => '/img/feedback/user3.jpg',
        'rating' => 5,
        'comment' => 'The ordering process is so easy and I Love the assistance you offer by guiding me throughout the whole process. This has facilitated everything for me in an awesome way. I greatly recommend you.',
        'date' => '2024-08-05',
    ],
]])

<section class="bg-white dark:bg-gray-800 py-16 transition-colors duration-300">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-gray-800 dark:text-yellow-500 mb-2">Customer Feedback</h2>
        <div class="w-24 h-1 bg-yellow-500 mx-auto mb-8"></div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($feedbacks as $feedback)
            <div class="bg-white dark:bg-gray-700 rounded-lg shadow-lg p-6 transition-transform duration-300 hover:transform hover:scale-105">
                <div class="flex items-center mb-4">
                    <img src="{{ $feedback['avatar'] }}" alt="{{ $feedback['name'] }}" class="w-14 h-14 rounded-full mr-4">
                    <div>
                        <h3 class="font-semibold text-gray-800 dark:text-yellow-500">{{ $feedback['name'] }}</h3>
                        <div class="flex text-yellow-500">
                            @for($i = 0; $i < 5; $i++)
                                @if($i < $feedback['rating'])
                                    <i class="fas fa-star"></i>
                                @else
                                    <i class="far fa-star"></i>
                                @endif
                            @endfor
                        </div>
                    </div>
                </div>
                <p class="text-gray-600 dark:text-gray-300 mb-4">{{ $feedback['comment'] }}</p>
                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $feedback['date'] }}</span>
            </div>
            @endforeach
        </div>

        <div class="mt-12 text-center">
            <button class="bg-yellow-500 text-white px-6 py-3 rounded-full hover:bg-yellow-600 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50">
                Leave Your Feedback
            </button>
        </div>
    </div>
</section>
