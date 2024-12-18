<?php

namespace App\Enums\Traits;

use Illuminate\Support\Arr;

trait EnumHelperTrait
{
    public static function options(): array
    {
        return Arr::mapWithKeys(self::cases(), function (self $class) {
            return [$class->name => $class->getLabel() ?? $class->value];
        });
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function getValueByName(string $name)
    {
        return Arr::get(self::options(), $name);
    }
}
