<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['client_id', 'total_price', 'status'];
    protected $casts = ['status' => OrderStatusEnum::class];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}

