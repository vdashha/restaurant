<?php
namespace App\Enums;


use App\Enums\Traits\EnumHelperTrait;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum DeliveryStatusEnum: string implements HasColor, HasLabel
{
    use EnumHelperTrait;
    case NEW = 'new';
    case PROCESS = 'process';
    case COMPLETED = 'completed';
    case FAILED = 'failed';

    public function getLabel(): string
    {
        return match ($this) {
            self::NEW => 'новый',
            self::PROCESS => 'готовится',
            self::COMPLETED => 'получен',
            self::FAILED => 'отменен',
        };
    }

    public function isNew(): bool
    {
        return $this === self::NEW;
    }

    public function isProcess(): bool
    {
        return $this === self::PROCESS;
    }

    public function isCompleted(): bool
    {
        return $this === self::COMPLETED;
    }

    public function isFailed(): bool
    {
        return $this === self::FAILED;
    }

    public function getColor(): string
    {
        return match ($this) {
            self::NEW => 'info',
            self::PROCESS => 'warning',
            self::COMPLETED => 'success',
            self::FAILED => 'danger',
        };
    }
}
