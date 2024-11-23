<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\UserController;

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

Route::get('/', [HomeController::class, 'index']);



Route::get('/about-us', function () {
    return view('about');
})->name('about.us');
Route::get('/our-team', function () {
    return view('team');
})->name('team');



Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin');

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

Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

// Routes for Wishlist
Route::middleware(['auth'])->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
    Route::post('/wishlist/add/{id}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::post('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::post('/wishlist/remove/product/{id}', [WishlistController::class, 'removeProduct'])->name('wishlist.removeProduct');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{product}', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::get('/my-cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('my-profile/settings', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/information', [ProfileController::class, 'information'])->name('profile.information');
    Route::get('/profile/orders', [ProfileController::class, 'orders'])->name('profile.orders');
    Route::get('/profile/wishlist', [ProfileController::class, 'wishlist'])->name('profile.wishlist');
    Route::get('/profile/addresses', [ProfileController::class, 'addresses'])->name('profile.addresses');
    Route::get('/profile/settings', [ProfileController::class, 'settings'])->name('profile.settings');

});


Route::prefix('admin')->group(function () {
  Route::controller(AdminCategoryController::class)->group(function () {

    Route::post('/add-category', 'storeCategory')->name('admin.categories.store');
        Route::get('/categories', 'categoryIndex')->name('categories.index');
        Route::get('/categories/create', 'createCategory')->name('categories.create');
        Route::post('/categories', 'storeCategory')->name('categories.store');
        Route::get('/categories/{id}/edit', 'editCategory')->name('categories.edit');
        Route::put('/categories/{id}', 'updateCategory')->name('categories.update');
        Route::delete('/categories/{id}', 'deleteCategory')->name('categories.destroy');
        Route::get('categories/{category}/subcategories', 'subcat')
        ->name('subcat');
    Route::get('categories/{category}/subcategories/create', 'create')
        ->name('subcategories.create');
    Route::post('categories/{category}/subcategories', 'storeSubCat')
        ->name('subcategories.store');
    Route::put('categories/{category}/subcategories/{subcategory}', 'updateSubCat')
        ->name('subcategories.update');
    Route::delete('categories/{category}/subcategories/{subcategory}', 'destroySubCat')
        ->name('subcategories.destroy');
    });

Route::controller(ColorController::class)->group(function () {
    Route::get('/attributes/colors', 'index')
    ->name('colors.index');

// Store a new color
    Route::post('/add-colors', 'store')
        ->name('colors.store');

    // Update an existing color
    Route::put('/updte-colors/{color}', 'update')
        ->name('colors.update');

    // Delete a color
    Route::delete('/delete-colors/{color}', 'destroy')
        ->name('colors.destroy');
    });

    Route::controller(AttributeController::class)->group(function () {
    Route::get('/attributes/types', 'indexType')->name('types.index');
    Route::post('/attributes/types', 'storeType')->name('types.store');
    Route::put('/types/{type}', 'updateType')->name('types.update');
    Route::delete('/types/{type}', 'destroyType')->name('types.destroy');

    // Quality routes
    Route::get('/attributes/qualities', 'indexQuality')->name('qualities.index');
    Route::post('/qualities', 'storeQuality')->name('qualities.store');
    Route::put('/qualities/{quality}', 'updateQuality')->name('qualities.update');
    Route::delete('/qualities/{quality}', 'destroyQuality')->name('qualities.destroy');

    // Size routes
    Route::get('/attributes/sizes', 'sizesIndex')->name('sizes.index');
    Route::post('/attributes/sizes', 'storeSize')->name('sizes.store');
    Route::put('/sizes/{size}', 'updateSize')->name('sizes.update');
    Route::delete('/sizes/{size}', 'destroySize')->name('sizes.destroy');
});


Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index')
    ->name('users.index');

    Route::get('/users/{user}/edit', 'edit')
    ->name('users.edit');

// Update user
Route::put('/users/{user}', 'update')
    ->name('users.update');

// Delete user
Route::delete('/users/{user}', 'destroy')
    ->name('users.destroy');
});

Route::get('/profile/{user}', [UserController::class, 'showProfile'])->name('profile.user');


});




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
    Route::get('/dashboard', [HomeController::class, 'index']
    )->name('dashboard');
});
