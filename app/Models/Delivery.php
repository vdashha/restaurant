<?php

namespace App\Models;

use App\Enums\DeliveryStatusEnum;
use App\Enums\OrderStatusEnum;
use App\Enums\PaymentMethodEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Delivery extends Model
{

    protected $fillable = ['order_id', 'address', 'time', 'status'];

    protected $casts = ['status' => DeliveryStatusEnum::class];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
