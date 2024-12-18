<?php

namespace App\Enums;


use App\Enums\Traits\EnumHelperTrait;
use Filament\Support\Contracts\HasLabel;

enum LanguageEnum: string implements HasLabel
{
    use EnumHelperTrait;

    case RUSSIAN = 'ru';
    case ENGLISH = 'en';

    public function getLabel(): string
    {
        return match ($this) {
            self::RUSSIAN => 'Русский',
            self::ENGLISH => 'English'
        };
    }


    public function isRussian(): bool
    {
        return $this === self::RUSSIAN;
    }

    public function isEanglish(): bool
    {
        return $this === self::ENGLISH;
    }
}
