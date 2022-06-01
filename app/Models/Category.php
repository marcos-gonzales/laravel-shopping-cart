<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    public function products() :HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function scopeShowCategory($query, $categoryId)
    {
        return Product::with('categories')->whereHas('categories', function($q) use($categoryId, $query) {
            $q->where('id', $categoryId);
        })->paginate();
    }

    public function scopeSimilarProducts($query, $category)
    {
        return Product::with('categories')
            ->where('id', '!=', $category->pivot->product_id)
            ->whereHas('categories', function($q) use($category) {
                $q->where('id', $category->id);
            })->limit(3)->get();
    }
}
