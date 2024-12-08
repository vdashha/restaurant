<?php
namespace App\Enums;

enum OrderStatusEnum: string
{
    case NEW = 'new';
    case PROCESS = 'process';
    case PENDING_DELIVERY = 'pending_delivery';
    case PROCESS_DELIVERY = 'process_delivery';
    case READY_TO_RECEIVE = 'ready_to_receive';
    case COMPLETED = 'completed';
    case FAILED = 'failed';

    public function label()
    {
        return match ($this) {
            self::NEW => 'новый',
            self::PROCESS => 'готовится',
            self::PENDING_DELIVERY => 'ожидает доставку',
            self::PROCESS_DELIVERY => 'доставляется',
            self::READY_TO_RECEIVE => 'готов к получению',
            self::COMPLETED => 'выдан',
            self::FAILED => 'отменен',
        };
    }
}
