<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
use App\Enums\PaymentMethodEnum;
use App\Observers\OrderObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property int $client_id
 * @property string $total_price
 * @property OrderStatusEnum $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $name
 * @property string|null $phone_number
 * @property string|null $time
 * @property string|null $adress
 * @property string|null $comment
 * @property PaymentMethodEnum|null $payment
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OrderItem> $items
 * @property-read int|null $items_count
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereAdress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @mixin \Eloquent
 */

#[ObservedBy([OrderObserver::class])]
class Order extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'total_price', 'status', 'name', 'phone_number', 'time', 'adress', 'comment', 'payment'];
    protected $casts = [
        'status' => OrderStatusEnum::class,
        'payment' => PaymentMethodEnum::class
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'adress');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}

