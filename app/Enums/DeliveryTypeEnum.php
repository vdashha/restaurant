<?php
namespace App\Enums;


use App\Enums\Traits\EnumHelperTrait;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum DeliveryTypeEnum: string implements HasColor, HasLabel
{
    use EnumHelperTrait;
    case DELIVERY = 'delivery';
    case PICKUP = 'pickup';

    public function getLabel(): string
    {
        return match ($this) {
            self::DELIVERY => 'Доставка',
            self::PICKUP => 'Самовывоз',
        };
    }

    public function isDelivery(): bool
    {
        return $this === self::DELIVERY;
    }

    public function isPickup(): bool
    {
        return $this === self::PICKUP;
    }

    public function getColor(): string
    {
        return match ($this) {
            self::DELIVERY, self::PICKUP  => 'info',
        };
    }
}
