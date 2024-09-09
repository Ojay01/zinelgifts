<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Subcategory;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Array of images to be used
        $images = ['img1.png', 'img2.png', 'img3.png', 'img4.png', 'img5.png'];

        // Loop through each category to seed products under its subcategories
        $categories = ProductCategory::with('subcategories')->get(); // Fetch categories with their subcategories

        foreach ($categories as $category) {
            foreach ($category->subcategories as $subcategory) {
                // For each subcategory, add 5 products
                for ($i = 1; $i <= 5; $i++) {
                    Product::create([
                        'name' => 'Product ' . $i . ' under ' . $subcategory->name,
                        'description' => 'This is the description for product ' . $i . ' under ' . $subcategory->name,
                        'price' => rand(50, 5000), 
                        'discount' => rand(0, 30), 
                        'image' => $images[array_rand($images)], 
                        'category_id' => $category->id, 
                        'subcategory_id' => $subcategory->id,
                    ]);
                }
            }
        }
    }
}
