<?php

namespace App\Services\Telegram;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;

final class Telegram
{
    private ?Client $guzzleClient = null;

/**
* Отправка сообщения в Telegram
*
* @param TelegramMessage $message
* @param string $chatId
* @param string $topicId
* @param string $parseMode
* @return array
* @throws \GuzzleHttp\Exception\GuzzleException
*/
    public function sendMessageToChat(
        TelegramMessage $message,
        string $chatId,
        string $topicId,
        string $parseMode = 'HTML'
    ): array {
        $payload = $this->prepareMessagePayload($message, $chatId, $topicId, $parseMode);
        try {
            $response = $this->getInternalClient()->post($payload['method'], [
                'json' => $payload['data'],
            ]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (ConnectException) {
            return [];
        } catch (ClientException $exception) {
            $response = $exception->getResponse()->getBody()->getContents();
            return json_decode($response, true);
        }
    }

/**
* Отправка документа в Telegram
*
* @param string $filePath
* @param string $chatId
* @param string|null $caption
* @throws \GuzzleHttp\Exception\GuzzleException
*/
    public function sendDocument(string $filePath, string $chatId, ?string $caption = null): void
    {
        $this->getInternalClient()->post('sendDocument', [
            'multipart' => [
                ['name' => 'document', 'contents' => fopen($filePath, 'r')],
                ['name' => 'chat_id', 'contents' => $chatId],
                ['name' => 'caption', 'contents' => $caption ?? ''],
            ],
        ]);
    }

/**
* Подготовка данных для отправки сообщения
*
* @param TelegramMessage $message
* @param string          $chatId
* @param string          $topicId
* @param string          $parseMode
*
* @return array
*/
    private function prepareMessagePayload(
        TelegramMessage $message,
        string $chatId,
        string $topicId,
        string $parseMode = 'HTML'
    ): array {;
        $data = [
            'chat_id' => $chatId,
            'reply_to_message_id' => $topicId,
        ];

        if ($message->hasMediaFiles()) {
            $mediaFiles = $this->prepareMediaGroup($message, $parseMode);

            return [
                'method' => 'sendMediaGroup',
                'data' => [
                    ...$data,
                    'media' => $mediaFiles,
                ],
            ];
        }

        return [
            'method' => 'sendMessage',
            'data' => [
                ...$data,
                'text' => $message->getText(),
                'parse_mode' => $parseMode,
                'disable_notification' => false,
                'disable_web_page_preview' => true,
            ],
        ];
    }

/**
* Подготовка группы медиа для отправки
*
* @param TelegramMessage $message
* @param string $parseMode
* @return array
*/
    private function prepareMediaGroup(TelegramMessage $message, string $parseMode): array
    {
        $firstFile = true;

        return array_map(function ($media) use ($message, &$firstFile, $parseMode) {
            $data = [
                'type' => 'photo',
                'media' => $media,
            ];

            if ($firstFile) {
                $data['caption'] = mb_substr(trim($message->getText()), 0, 1024);
                $data['parse_mode'] = $parseMode;
                $firstFile = false;
            }

            return $data;
        }, $message->getMediaFiles());
    }
    /**
     * Получение HTTP-клиента
     *
     * @return Client
     */
    private function getInternalClient(): Client
    {
        if ($this->guzzleClient === null) {
            $this->guzzleClient = new Client([
                'base_uri' => 'https://api.telegram.org/bot' . config('services.telegram.bot_token') . '/',
                'verify' => false,
                'connect_timeout' => 5,
            ]);
        }

        return $this->guzzleClient;
    }
}
