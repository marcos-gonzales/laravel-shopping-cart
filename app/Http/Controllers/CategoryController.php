<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use App\Models\Product;


class CategoryController extends Controller
{
    public function index (Category $category)
    {
        $categoryId = $category->id;
        $products = Product::whereHas('categories', function($query) use($categoryId) {
            $query->where('id', $categoryId);
        })->paginate();
        return Inertia::render('Categories/Index', [
           'products' => $products
       ]);
    }
}
