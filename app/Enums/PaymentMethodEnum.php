<?php

namespace App\Enums;


use App\Enums\Traits\EnumOptionsTrait;

enum PaymentMethodEnum: string
{
    use EnumOptionsTrait;

    case CARD = 'card';
    case CASH = 'cash';

    public function label(): string
    {
        return match ($this) {
            self::CARD => 'Оплата картой',
            self::CASH => 'Оплата наличными'
        };
    }

    public function isCard(): bool
    {
        return $this === self::CARD;
    }

    public function isCash(): bool
    {
        return $this === self::CASH;
    }
}
