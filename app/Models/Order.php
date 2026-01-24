<?php

namespace App\Models;

use Faker\Provider\Payment;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'buyer_id',
        'seller_id',
        'total_price',
        'status',
    ];

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
