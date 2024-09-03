
@props(['steps' => [
    ['number' => '1', 'title' => 'Get in touch', 'description' => ' Contact and choose which product you will want us to design and print for you as you provide all necessary details about the project.'],
    ['number' => '2', 'title' => 'Execute', 'description' => 'Your project executed and sent to you for corrections. Our team makes sure that the job is well carried out and confirmed for printing.'],
    ['number' => '3', 'title' => 'Delivery', 'description' => 'Your project is printed and still checked by the quality control team to make Sure, the final output is perfect as expected after which the product is delivered directly to your given location on time.'],

]])

<section class="bg-gray-100 dark:bg-gray-900 dark:text-yellow-500 py-20">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($steps as $step)
            <div class="flex flex-col items-start text-left">
                <div class="flex items-center mb-2">
                    <span class="text-4xl sm:text-5xl font-bold hover:text-yellow-500 dark:text-yellow-500 mr-3">{{ $step['number'] }}.</span>
                    <h3 class="text-2xl sm:text-3xl font-semibold hover:text-yellow-500 dark:text-yellow-500">{{ $step['title'] }}</h3>
                </div>
                <p class="text-md xl:text-lg hover:text-yellow-500 dark:text-yellow-400/70 mt-2">{{ $step['description'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>