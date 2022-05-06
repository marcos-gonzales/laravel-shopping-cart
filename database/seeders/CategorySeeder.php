<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
