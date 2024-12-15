<?php
namespace App\Enums;


use App\Enums\Traits\EnumOptionsTrait;

enum OrderStatusEnum: string
{
    use EnumOptionsTrait;
    case NEW = 'new';
    case PROCESS = 'process';
    case PENDING_DELIVERY = 'pending_delivery';
    case PROCESS_DELIVERY = 'process_delivery';
    case READY_TO_RECEIVE = 'ready_to_receive';
    case COMPLETED = 'completed';
    case FAILED = 'failed';

    public function label(): string
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
}
