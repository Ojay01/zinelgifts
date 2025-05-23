<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::post('/subscribe', [ContactController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/login/{provider}', [SocialController::class, 'redirect'])->name('social.login');
Route::get('/login/{provider}/callback', [SocialController::class, 'callback']);

Route::get('/api/categories/{category}/subcategories', [ProductsController::class, 'getSubcategories']);


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


// Routes for Wishlist
Route::middleware(['auth', 'verified'])->prefix('account')->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
    Route::post('/wishlist/add/{id}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::post('/wishlist/remove/{id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::post('/wishlist/remove/product/{id}', [WishlistController::class, 'removeProduct'])->name('wishlist.removeProduct');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{product}', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::get('/my-cart', [CartController::class, 'index'])->name('cart');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/placeOrder', [CheckoutController::class, 'placeOrder'])->name('placeOrder');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('my-profile/settings', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/information', [ProfileController::class, 'information'])->name('profile.information');
    Route::get('/profile/orders', [ProfileController::class, 'orders'])->name('profile.orders');
    Route::get('/profile/wishlist', [ProfileController::class, 'wishlist'])->name('profile.wishlist');
    Route::get('/profile/addresses', [ProfileController::class, 'addresses'])->name('profile.addresses');
    Route::get('/profile/settings', [ProfileController::class, 'settings'])->name('profile.settings');
    Route::post('/profile/update/profile/picture', [ProfileController:: class, 'updateProfilePicture'])->name('profile.updateProfilePicture');
    Route::post('/profile/update/profile', [ProfileController:: class, 'updateProfile'])->name('profile.updateProfile');
    Route::post('/profile/update/password', [ProfileController:: class, 'updatePassword'])->name('profile.updatePassword');

    Route::post('/addresses', [AddressController::class, 'store'])
    ->name('addresses.store');

Route::delete('/addresses/{address}', [AddressController::class, 'destroy'])
    ->name('addresses.destroy');
});


Route::prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index' ])->name('admin');

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


Route::get('/profile/{user}',  'showProfile')->name('profile.user');

Route::get('/users/wishlists/',  'userWishlist')->name('wishlist.user');
Route::delete('/user/wishlist/{wishlist}',  'destroyWishlist')->name('wishlists.destroy');

Route::get('/users/carts/', 'userCarts')->name('carts.user');
});


Route::controller(ProductsController::class)->group(function () {
    Route::get('/product/all-products', 'index')
    ->name('products.index');

    Route::get('/product/create-product', 'create')
    ->name('products.create');

    Route::get('/product/edit/{product}', 'edit')
    ->name('products.edit');

    Route::patch('/product/toggle-featured/{product}', 'toggleFeatured')
    ->name('products.toggleFeatured');

    Route::patch('/product/update-status/{product}', 'updateStatus')
    ->name('products.updateStatus');

    Route::delete('/product/destroy/{id}', 'destroy')
    ->name('products.destroy');

    Route::put('/product/update/{product}', 'update')
    ->name('products.update');

    Route::post('/product/store/', 'store')
    ->name('products.store');
    Route::post('/products/{product}/upload-image', 'uploadImage')->name('products.uploadImage');
    Route::delete('/product-images/{image}', 'destroyProductImage')->name('product-images.destroy');

});

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
