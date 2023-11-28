<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'photo', 'product_category_id', 'quantity', 'shop_id'];
    public function productCategory(): BelongsTo
    {
        return $this->belongsTo(productCategory::class);
    }
    public function cartProducts(): HasMany
    {
        return $this->hasMany(cartProduct::class);
    }
    public function orderDetails(): HasMany
    {
        return $this->hasMany(orderDetails::class);
    }
    public function shop(): BelongsTo
    {
        return $this->belongsTo(shop::class);
    }
}
