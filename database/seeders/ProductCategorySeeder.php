<?php

namespace Database\Seeders;

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;
use App\Models\Subcategory;

class ProductCategorySeeder extends Seeder
{
    public function run()
    {
        // Event Gifts
        $category = ProductCategory::create([
            'name' => 'Event Gifts',
            'description' => 'Gifts for various events such as birthdays, weddings, memorials, and more.',
        ]);

        $subcategories = [
            ['name' => 'Birthday Gifts', 'category_id' => $category->id],
            ['name' => 'Wedding Gifts', 'category_id' => $category->id],
            ['name' => 'Memorial Gifts', 'category_id' => $category->id],
            ['name' => 'Comedy Shows', 'category_id' => $category->id],
            ['name' => 'Movie Premiers', 'category_id' => $category->id],
            ['name' => 'Arts & Culture', 'category_id' => $category->id],
            ['name' => 'Concerts', 'category_id' => $category->id],
            ['name' => 'Award Ceremonies', 'category_id' => $category->id],
        ];

        foreach ($subcategories as $subcategory) {
            Subcategory::create($subcategory);
        }

        // Special Days Gifts
        $category = ProductCategory::create([
            'name' => 'Special Days Gifts',
            'description' => 'Gifts for special occasions like Valentine’s Day, Mother’s Day, and more.',
        ]);

        $subcategories = [
            ['name' => 'Valentine’s Day Gifts', 'category_id' => $category->id],
            ['name' => 'Mothers’ Day Gifts', 'category_id' => $category->id],
            ['name' => 'Fathers’ Day Gifts', 'category_id' => $category->id],
            ['name' => 'Easter Gifts', 'category_id' => $category->id],
            ['name' => 'Christmas Gifts', 'category_id' => $category->id],
            ['name' => 'New Year Gifts', 'category_id' => $category->id],
            ['name' => 'Labour Day', 'category_id' => $category->id],
        ];

        foreach ($subcategories as $subcategory) {
            Subcategory::create($subcategory);
        }

        // Corporate Gifts
        $category = ProductCategory::create([
            'name' => 'Corporate Gifts',
            'description' => 'Gifts for organizations like NGOs, associations, schools, and more.',
        ]);

        $subcategories = [
            ['name' => 'NGOs', 'category_id' => $category->id],
            ['name' => 'Associations', 'category_id' => $category->id],
            ['name' => 'Conferences', 'category_id' => $category->id],
            ['name' => 'Seminars', 'category_id' => $category->id],
            ['name' => 'Common Initiative Groups', 'category_id' => $category->id],
            ['name' => 'Schools', 'category_id' => $category->id],
            ['name' => 'Churches', 'category_id' => $category->id],
        ];

        foreach ($subcategories as $subcategory) {
            Subcategory::create($subcategory);
        }

        // Home & Decor Gifts
        $category = ProductCategory::create([
            'name' => 'Home & Decor Gifts',
            'description' => 'Gifts for home decor and event decorations.',
        ]);

        $subcategories = [
            ['name' => 'Interior Décor', 'category_id' => $category->id],
            ['name' => 'Event Decor', 'category_id' => $category->id],
            ['name' => 'Epoxy Flooring', 'category_id' => $category->id],
            ['name' => 'Family Enlargements', 'category_id' => $category->id],
            ['name' => 'Epoxy Wall', 'category_id' => $category->id],
            ['name' => 'Flower Jars', 'category_id' => $category->id],
            ['name' => 'Portraits and Paintings', 'category_id' => $category->id],
            ['name' => 'Clocks', 'category_id' => $category->id],
            ['name' => 'Backdrops', 'category_id' => $category->id],
            ['name' => 'Floor Drops', 'category_id' => $category->id],
        ];

        foreach ($subcategories as $subcategory) {
            Subcategory::create($subcategory);
        }

        // Congratulation Gifts
        $category = ProductCategory::create([
            'name' => 'Congratulation Gifts',
            'description' => 'Gifts for special moments like baby showers, graduations, and more.',
        ]);

        $subcategories = [
            ['name' => 'Baby Shower', 'category_id' => $category->id],
            ['name' => 'Graduations', 'category_id' => $category->id],
            ['name' => 'Baptism', 'category_id' => $category->id],
            ['name' => 'Confirmation', 'category_id' => $category->id],
            ['name' => 'Ordination', 'category_id' => $category->id],
            ['name' => 'Appointments', 'category_id' => $category->id],
        ];

        foreach ($subcategories as $subcategory) {
            Subcategory::create($subcategory);
        }

        // Consumable Gifts
        $category = ProductCategory::create([
            'name' => 'Consumable Gifts',
            'description' => 'Gift baskets and consumables like cakes and drinks.',
        ]);

        $subcategories = [
            ['name' => 'Gift Baskets', 'category_id' => $category->id],
            ['name' => 'Cakes', 'category_id' => $category->id],
            ['name' => 'Cookies', 'category_id' => $category->id],
            ['name' => 'Biscuits', 'category_id' => $category->id],
            ['name' => 'Sweets', 'category_id' => $category->id],
            ['name' => 'Candys', 'category_id' => $category->id],
            ['name' => 'Flowers', 'category_id' => $category->id],
            ['name' => 'Drinks (wine whisky campaign)', 'category_id' => $category->id],
        ];

        foreach ($subcategories as $subcategory) {
            Subcategory::create($subcategory);
        }

        // Luxury Gifts
        $category = ProductCategory::create([
            'name' => 'Luxury Gifts',
            'description' => 'Luxury gift items including branded products and fashion accessories.',
        ]);

        $subcategories = [
            ['name' => 'Jewelries', 'category_id' => $category->id],
            ['name' => 'Apparels', 'category_id' => $category->id],
            ['name' => 'Fashion', 'category_id' => $category->id],
        ];

        foreach ($subcategories as $subcategory) {
            Subcategory::create($subcategory);
        }
    }
}

