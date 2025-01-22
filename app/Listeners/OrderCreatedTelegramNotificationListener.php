<?php

namespace App\Listeners;


use App\Events\OrderCreated;
use App\Jobs\SendTelegramMessageJob;
use App\Models\Order;
use App\Services\Telegram\TelegramMessage;

class OrderCreatedTelegramNotificationListener
{
    /**
     * Handle the event.
     *
     * @param OrderCreated $event
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
        $message = '*Заказ: №*' . $order->id . PHP_EOL ;
        $message .= '*Сумма: ' . $order->total_price . ' BYN*' . PHP_EOL ;
        $message .= '*Создан: * ' . $order->created_at->format('Y-m-d H:i') . PHP_EOL;
        $message .= '*Номер телефона: * ' . $order->phone_number . PHP_EOL;
        $message .= '*Способ получения заказа: * ' . $order->delivery_type->getLabel() . PHP_EOL;
        if ($order->delivery_type->isPickup()){
            $message .= '*Адрес: * ' . $order->adress . PHP_EOL;
        } else {
            $message .= '*Адрес: * ' . $order->delivery->address . PHP_EOL;
        }

        $message .= '*Комментарий: * ' . $order->comment . PHP_EOL;

        return new TelegramMessage($message);
    }
}
