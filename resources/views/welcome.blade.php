
<x-guest-layout>
    <x-header />
    <x-slider :slides="$slides" />

    <x-process />
    <x-category :categories="$categories" />
    <x-specialOffer />
    <x-advert />
    <x-featured-products 
    :products="$products" 
    :wishlist="$wishlist"
    :special-offers="[
        [
            'title' => '25 Ideas For Modern Interior',
            'subtitle' => 'Adipiscing lorem class',
            'image' => 'https://picsum.photos/seed/interior/600/400'
        ],
        [
            'title' => 'Beds And Sofas With 15% Discount',
            'subtitle' => 'Nullam nunc scelerisque',
            'image' => 'https://picsum.photos/seed/bedroom/600/400'
        ]
    ]" 
/>
    <x-partners />
    <x-feedback />
    <x-footer />
</x-guest-layout>