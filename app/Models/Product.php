<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Request;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'file_path'
    ];

    public function categories() :BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function orders() :BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }

    public function scopeGetProducts($query) :LengthAwarePaginator
    {
        return $query->with('categories')
            ->when(Request::input('query'), function($query, $q) {
                $query->where('slug', 'like', '%' . $q . '%')
                    ->orWhere('description', 'like', '%' . $q . '%');
            })->paginate();

    }

    public function scopeShowProduct($query, $id) :Product
    {
        return $query->with('categories')->findOrFail($id);
    }
}
