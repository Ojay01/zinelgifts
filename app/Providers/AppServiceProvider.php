<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\ProductCategory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share the categories and subcategories across both components
        View::composer(['components.category-dropdown', 'components.header'], function ($view) {
            $categories = ProductCategory::with('subcategories')->get();
            $view->with('categories', $categories);
        });
    }
    

}
