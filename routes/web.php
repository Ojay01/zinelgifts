<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::post('/subscribe', [ContactController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/login/{provider}', [SocialController::class, 'redirect'])->name('social.login');
Route::get('/login/{provider}/callback', [SocialController::class, 'callback']);

//blogs
Route::get('/blogs', [BlogPostController::class, 'index'])->name('blogs');
Route::get('/blog/{slug}', [BlogPostController::class, 'show'])->name('blog.details');
Route::get('/blog/create', [BlogPostController::class, 'create'])->name('blog.create');
Route::post('/blog', [BlogPostController::class, 'store'])->name('blog.store');
Route::get('/blog/{slug}/edit', [BlogPostController::class, 'edit'])->name('blog.edit');
Route::put('/blog/{slug}', [BlogPostController::class, 'update'])->name('blog.update');
Route::delete('/blog/{slug}', [BlogPostController::class, 'destroy'])->name('blog.destroy');

//category
Route::get('/product/category/{id}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/product/category/sub-category/{id}', [CategoryController::class, 'showSubcategory'])->name('subcategory.show');

//product
Route::get('/product-detail/{category}/{subcategory}/{product}', [ProductController::class, 'show'])->name('details');
Route::get('/product/shop-today', [ProductController::class, 'shop'])->name('shop');


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

Route::get('/my-cart', function () {
    return view('cart');
})->name('cart');
Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

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
