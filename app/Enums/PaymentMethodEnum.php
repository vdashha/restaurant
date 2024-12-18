<?php

namespace App\Enums;


use App\Enums\Traits\EnumOptionsTrait;
use Filament\Support\Contracts\HasLabel;

enum PaymentMethodEnum: string implements HasLabel
{
    use EnumOptionsTrait;

    case CARD = 'card';
    case CASH = 'cash';

    public function getLabel(): string
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
