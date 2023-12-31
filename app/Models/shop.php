<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class shop extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address',
        'user_id'
    ];
    public function product(): HasMany
    {
        return $this->hasMany(product::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(shop::class);
    }
}
