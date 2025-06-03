<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\BlogPost;
use App\Models\ProductCategory;
use App\Models\Subcategory;
use App\Models\Product;

class GenerateSitemapTxt extends Command
{
    protected $signature = 'generate:sitemap';
    protected $description = 'Generate a sitemap.xml file with dynamic route content from models';

    public function handle()
    {
        $sitemap = Sitemap::create();

        // ✅ Add static GET routes (excluding API/internal/etc.)
        $excludedBaseUris = [
            'email/verify', 'reset-password', 'user', 'sanctum/csrf-cookie',
            'livewire/livewire.js', 'livewire/livewire.min.js.map',
            'livewire/preview-file', 'up', '_', 'api'
        ];

        $routes = collect(Route::getRoutes())->filter(function ($route) use ($excludedBaseUris) {
            if (!in_array('GET', $route->methods())) return false;

            $uri = $route->uri();
            foreach ($excludedBaseUris as $excluded) {
                if (str_starts_with($uri, $excluded)) return false;
            }

            return true;
        });

        foreach ($routes as $route) {
            $uri = $route->uri();

            // Static routes only
            if (!str_contains($uri, '{')) {
                $url = url($uri);
                $sitemap->add(
                    Url::create($url)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                        ->setPriority(0.8)
                );
            }
        }

        // ✅ Add dynamic blog posts
        foreach (BlogPost::where('status', 'published')->get() as $post) {
            $url = route('blog.details', $post->slug);
            $sitemap->add(
                Url::create($url)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.9)
            );
        }

        // ✅ Add dynamic categories
        foreach (ProductCategory::all() as $category) {
            $url = route('category.show', $category->id);
            $sitemap->add(
                Url::create($url)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.7)
            );
        }

        // ✅ Add dynamic subcategories
        foreach (Subcategory::whereNotNull('category_id')->get() as $subcategory) {
            $url = route('subcategory.show', $subcategory->id);
            $sitemap->add(
                Url::create($url)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.6)
            );
        }

        // ✅ Add dynamic product pages
        // foreach (Product::where('status', true)->get() as $product) {
        //     $url = route('details', [
        //         'category' => $product->category->slug,
        //         'subcategory' => $product->subcategory->slug,
        //         'product' => $product->slug,
        //     ]);
        //     $sitemap->add(
        //         Url::create($url)
        //             ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
        //             ->setPriority(1.0)
        //     );
        // }

//         // ✅ Add dynamic product detail pages
foreach (Product::with(['category', 'subcategory'])->where('status', true)->get() as $product) {
    // Make sure category and subcategory exist
    if (!$product->category || !$product->subcategory) {
        continue;
    }

    $url = route('details', [
        'category' => $product->category->name,
        'subcategory' => $product->subcategory->name,
        'product' => $product->name,
    ]);

    $sitemap->add(
        Url::create($url)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(1.0)
    );
}


        // ✅ Shop route
        $sitemap->add(
            Url::create(route('shop'))
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.8)
        );

        // ✅ Write to file
        $sitemap->writeToFile(public_path('sitemap.xml'));
        $this->info('✅ sitemap.xml generated successfully.');
    }
}
