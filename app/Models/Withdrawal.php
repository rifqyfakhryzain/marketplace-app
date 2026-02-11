<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $fillable = [
        'seller_id',
        'amount',
        'status',
        'admin_id'
    ];

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
