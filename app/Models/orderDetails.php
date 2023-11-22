<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class orderDetails extends Model
{
    use HasFactory;
    protected $fillable = ['quantity', 'product_id', 'order_id'];
    public function product(): BelongsTo
    {
        return $this->belongsTo(product::class);
    }
    public function order(): BelongsTo
    {
        return $this->belongsTo(order::class);
    }
}
