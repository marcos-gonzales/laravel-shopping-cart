<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'transaction_id',
        'total',
        'quantity',
        'is_complete'
    ];

    public function products() :BelongsToMany
    {
        return $this->BelongsToMany(Product::class)->withPivot('quantity', 'product_id', 'order_id');
    }

    public function categories()
    {
        return $this->hasManyThrough(Category::class,Product::class);
    }

    public function scopeGetOrder($query)
    {
        $order = Order::with('products')->where('user_id', auth()->user()->id)->where('is_complete', 0)->first();

        $order = $query->where('user_id', auth()->user()->id)
            ->where('is_complete', 0)->latest()->first();
        if($order == null) {
            return null;
        } else {
            return $order;
        }

    }

    public function scopeProductsInCart($query)
    {
        return $query->with('products')
            ->where('user_id', auth()->user()->id)
            ->where('is_complete',  0)
            ->withSum('products', 'price')
            ->get();
    }

    public function scopeRemoveProductFromCart($query, $product)
    {
        $order = $query->where('user_id', auth()->user()->id)
            ->where('is_complete', 0)
            ->with(['products' => function($q) use($product) {
                $q->where('product_id', $product);
            }])->first();

        $order->products()->detach(['product_id' => $product]);
        $order->syncChanges();
        return $order;
    }

    public function scopeGetOrders($query)
    {
        return $query->with('products')->where('user_id', auth()->user()->id)->get();
    }
}
