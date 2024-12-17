<?php

namespace App\Enums\Traits;

use Illuminate\Support\Arr;

trait EnumOptionsTrait
{
    public static function options(): array
    {
        return Arr::mapWithKeys(self::cases(), function (self $class) {
            return [$class->name => $class->getLabel() ?? $class->value];
        });
    }

    public static function getValueByName(string $name)
    {
        return Arr::get(self::options(), $name);
    }
}
