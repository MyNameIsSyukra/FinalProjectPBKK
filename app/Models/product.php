<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class product extends Model
{
    use HasFactory;
    protected $fillable = ['name','decription','price','product_category','quantity','shop_id'];
    public function product_category() : BelongsTo {
        return $this->belongsTo(product_category::class);
    }
    public function cart_products () : HasMany {
        return $this->hasMany(cart_product::class);
    }
    public function order_details() : HasMany {
        return $this->hasMany(order_details::class);
    }
    public function shop() : BelongsTo {
        return $this->belongsTo(shop::class); 
    }
}
