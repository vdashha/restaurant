<?php
namespace App\Enums;


use App\Enums\Traits\EnumOptionsTrait;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum OrderStatusEnum: string implements HasColor, HasLabel
{
    use EnumOptionsTrait;
    case NEW = 'new';
    case PROCESS = 'process';
    case PENDING_DELIVERY = 'pending_delivery';
    case PROCESS_DELIVERY = 'process_delivery';
    case READY_TO_RECEIVE = 'ready_to_receive';
    case COMPLETED = 'completed';
    case FAILED = 'failed';

    public function getLabel(): string
    {
        return match ($this) {
            self::NEW => 'новый',
            self::PROCESS => 'готовится',
            self::PENDING_DELIVERY => 'ожидает доставку',
            self::PROCESS_DELIVERY => 'доставляется',
            self::READY_TO_RECEIVE => 'готов к получению',
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

    public function isPendingDelivery(): bool
    {
        return $this === self::PENDING_DELIVERY;
    }

    public function isProcessDelivery(): bool
    {
        return $this === self::PROCESS_DELIVERY;
    }

    public function isReadyToReceive(): bool
    {
        return $this === self::READY_TO_RECEIVE;
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
            self::PENDING_DELIVERY, self::PROCESS_DELIVERY => 'primary',
            self::READY_TO_RECEIVE, self::COMPLETED => 'success',
            self::FAILED => 'danger',
        };
    }
}
