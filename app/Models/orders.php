<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class orders extends Model
{
    use HasFactory;
    protected $fillable = ['total','user_id','status_payment','amount','screenshot'];
    public function order_details() : HasMany {
        return $this->hasMany(order_details::class);
    }
    public function user() : BelongsTo {
        return $this->belongsTo(users::class);
    }
}
