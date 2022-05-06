<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Category::create(['name' => 'books', 'slug' => 'books']);
        Category::create(['name' => 'men', 'slug' => 'men']);
        Category::create(['name' => 'women', 'slug' => 'women']);
        Category::create(['name' => 'electronics', 'slug' => 'electronics']);
        Category::create(['name' => 'kids', 'slug' => 'kids']);
        Category::create(['name' => 'baby', 'slug' => 'baby']);
        Category::create(['name' => 'beauty and personal care', 'slug' => 'beauty-and-personal-care']);
        Category::create(['name' => 'pet', 'slug' => 'pet']);
        Category::create(['name' => 'home improvement', 'slug' => 'home-improvement']);
        Category::create(['name' => 'clothing', 'slug' => 'clothing']);
        Category::create(['name' => 'kitchen and bath', 'slug' => 'kitchen-and-bath']);
        Category::create(['name' => 'computers', 'slug' => 'computers']);
        Category::create(['name' => 'miscellaneous', 'slug' => 'miscellaneous']);

        Product::factory()->count(50)->create();

        $categories = Category::all();

        Product::all()->each(function ($product) use($categories) {
            $product->categories()->attach($categories->random(rand(1, 2))->pluck('id', 'name')->toArray());
        });
    }
}
