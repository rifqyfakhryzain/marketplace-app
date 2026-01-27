<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Escrow extends Model
{
    protected $fillable = [
        'buyer_id',
        'seller_id',
        'amount',
        'status',
        'admin_id',
    ];

    public function buyer() {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function  seller() {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
