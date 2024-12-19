<?php

namespace App\Listeners;


use App\Models\Order\Order;
use App\Events\OrderCreated;
use App\Jobs\SendTelegramMessageJob;
use App\Services\Telegram\TelegramMessage;

class OrderCreatedTelegramNotificationListener
{
    /**
     * Handle the event.
     *
     * @param \App\Events\OrderCreated $event
     *
     * @return void
     */
    public function handle(OrderCreated $event): void
    {
        $telegramMessage = $this->createMessage($event->order);

        dispatch(new SendTelegramMessageJob(
            message: $telegramMessage,
            chatId: config('services.telegram.chat_id'),
            topicId: config('services.telegram.notification_thread_id'),
            parseMode: 'Markdown'
        ));
    }

    private function createMessage(Order $order): TelegramMessage
    {
        $message = '*Заказ #*' . $order->id . PHP_EOL ;
        $message .= '*Создан:* ' . $order->creation_type->label() . PHP_EOL;
        $message .= '*Номер телефона:* ' . $order->phone . PHP_EOL;
        $message .= '*Адрес:* ' . $order->address . PHP_EOL;
        $message .= '*Комментарий:* ' . $order->comment . PHP_EOL;

        return new TelegramMessage($message);
    }
}
