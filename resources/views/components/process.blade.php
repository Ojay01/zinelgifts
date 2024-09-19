@props(['steps' => [
    ['icon' => 'fa-comments', 'title' => 'Get in touch', 'description' => 'Contact and choose which product you will want us to design and print for you as you provide all necessary details about the project.'],
    ['icon' => 'fa-cogs', 'title' => 'Execute', 'description' => 'Your project executed and sent to you for corrections. Our team makes sure that the job is well carried out and confirmed for printing.'],
    ['icon' => 'fa-truck', 'title' => 'Delivery', 'description' => 'Your project is printed and still checked by the quality control team to make Sure, the final output is perfect as expected after which the product is delivered directly to your given location on time.'],
]])

<!-- Include FontAwesome in your layout or at the top of this component -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<section class="bg-gray-100 dark:bg-gray-900 dark:text-yellow-500 py-20">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($steps as $step)
            <div class="flex flex-col items-start text-left">
                <div class="flex items-center mb-4">
                    <span class="text-4xl sm:text-5xl text-yellow-500 dark:text-yellow-500 mr-4">
                        <i class="fas {{ $step['icon'] }}"></i>
                    </span>
                    <h3 class="text-2xl sm:text-3xl uppercase font-semibold hover:text-yellow-500 dark:text-yellow-500">{{ $step['title'] }}</h3>
                </div>
                <p class="text-md xl:text-lg text-gray-700 dark:text-white/70 hover:text-yellow-500 dark:hover:text-yellow-500 mt-2">{{ $step['description'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>