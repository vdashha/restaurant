<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
use App\Enums\PaymentMethodEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['client_id', 'total_price', 'status', 'name', 'phone_number', 'time', 'adress', 'comment', 'payment'];
    protected $casts = [
        'status' => OrderStatusEnum::class,
        'payment' => PaymentMethodEnum::class
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}

