<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'decription', 'price', 'photo', 'product_category', 'quantity', 'shop_id'];
    public function product_category(): BelongsTo
    {
        return $this->belongsTo(productCategory::class);
    }
    public function cart_products(): HasMany
    {
        return $this->hasMany(cartProduct::class);
    }
    public function order_details(): HasMany
    {
        return $this->hasMany(orderDetails::class);
    }
    public function shop(): BelongsTo
    {
        return $this->belongsTo(shop::class);
    }
}
