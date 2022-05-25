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
        return $this->BelongsToMany(Product::class)->withPivot('quantity');
    }
}
