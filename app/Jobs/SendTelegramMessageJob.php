<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Services\Telegram\Telegram;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\Telegram\TelegramMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendTelegramMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

/**
* Create a new job instance.
*/
    public function __construct(
        private readonly TelegramMessage $message,
        private readonly string $chatId,
        private readonly string $topicId,
        private readonly string $parseMode,
    )
    {
        $this->onQueue('low');
    }

/**
* Execute the job.
* @throws \GuzzleHttp\Exception\GuzzleException
*/
    public function handle(Telegram $telegram): void
    {
        if (app()->isLocal()) {
            return;
        }

        $telegram->sendMessageToChat($this->message, $this->chatId, $this->topicId, $this->parseMode);
    }
}
