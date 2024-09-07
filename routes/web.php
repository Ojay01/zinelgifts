<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/about-us', function () {
    return view('about');
})->name('about.us');
Route::get('/our-team', function () {
    return view('team');
})->name('team');
Route::get('/contact-us', function () {
    return view('contact');
})->name('contact');
Route::get('/our-services', function () {
    return view('services');
})->name('services');
Route::get('/our-privacy-policy', function () {
    return view('policy');
})->name('policy');
Route::get('/our-terms and services', function () {
    return view('terms');
})->name('terms');
Route::get('/shop-today', function () {
    return view('shop');
})->name('shop');
Route::get('/product-detail', function () {
    return view('details');
})->name('details');
Route::get('/my-cart', function () {
    return view('cart');
})->name('cart');
Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');
Route::get('/blogs', function () {
    return view('blogs');
})->name('blogs');
Route::get('/blogs/category', function () {
    return view('blogs_details');
})->name('blog.details');
// Routes for Wishlist
Route::get('/wishlist', function () {
    // Example route to show the wishlist
    return view('wishlist');
})->name('wishlist');

// Route to remove an item from the wishlist
Route::post('/wishlist/remove/{id}', function ($id) {
    // Logic to remove the item from the wishlist
    return back()->with('message', 'Item removed from wishlist');
})->name('wishlist.remove');

// Route to view product details
Route::get('/product/{id}', function ($id) {
    // Logic to display product details
    return view('product-details', ['id' => $id]);
})->name('product.details');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
