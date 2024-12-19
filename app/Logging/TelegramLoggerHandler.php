<?php

namespace App\Logging;

use Monolog\Logger;
use Psr\Log\LogLevel;
use Illuminate\Support\Str;
use App\Services\Telegram\Telegram;
use App\Services\Telegram\TelegramMessage;
use Monolog\Handler\AbstractProcessingHandler;
use Symfony\Component\Mailer\Exception\TransportException;

/**
* @phpstan-import-type Record from Logger
* @phpstan-import-type Level from Logger
* @phpstan-import-type LevelName from Logger
*/
class TelegramLoggerHandler extends AbstractProcessingHandler
{
    private array $ignore = [
        TransportException::class,
    ];

    private array $ignoreCallStack = [];

    private string $applicationUrl;

    private string $applicationEnvironment;

/**
* @phpstan-param  Level|LevelName|LogLevel::* $logLevel
*/
    public function __construct($logLevel)
    {
        $monologLevel = Logger::toMonologLevel($logLevel);

        parent::__construct($monologLevel);

        $this->applicationUrl = request()->url();
        $this->applicationEnvironment = config('app.env');
    }

/**
* @phpstan-param Record $record
* @throws \GuzzleHttp\Exception\GuzzleException
*/
    protected function write(array|\Monolog\LogRecord $record): void
    {
        if ($this->ignoreError($record)) {
            return;
        }

        (new Telegram())
            ->sendMessageToChat(
                message: new TelegramMessage($this->formatLogText($record)),
                chatId: config('services.telegram.chat_id'),
                topicId: config('services.telegram.error_thread_id'),
                parseMode: 'Markdown'
            );
    }

/**
* @phpstan-param Record $record
*/
    protected function formatLogText(\Monolog\LogRecord $record): string
    {
        [$file, $context] = $this->getContextAndFile($record);

        $logText = '*App URL:* [' . $this->applicationUrl . '](' . $this->applicationUrl . ')' . PHP_EOL;
        $logText .= '*Environment:* ' . $this->applicationEnvironment . PHP_EOL;
        $logText .= '*Log Level:* #' . $record['level_name'] . PHP_EOL;

        if ($file) {
            $logText .= '*File:* ' . $file . '' . PHP_EOL;
        }

        $logText .= '*Message:* ' . ' ' . str_replace('`', '', $record['message']) . '' . PHP_EOL . PHP_EOL;

        if ($context && !$this->ignoreCallStack($record)) {
            $logText .= '' . PHP_EOL . $context . '' . PHP_EOL;
        }

        return Str::limit($logText, 3040, PHP_EOL . '```');
    }

    /**
     * @phpstan-param Record $record
     *
     * @return array<?string>
     */
    protected function getContextAndFile(\Monolog\LogRecord $record): array
    {
        $file = null;
        $context = null;

        if (!empty($record['context'])) {
            if (isset($record['context']['exception'])) {
                $exception = $record['context']['exception'];
                $context = $exception->getTraceAsString();
                $file = $exception->getFile() . ':' . $exception->getLine();
            } else {
                $context = json_encode(
                    $record['context'],
                    JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
                );
            }
        }

        return [$file, $context];
    }

    private function ignoreError(\Monolog\LogRecord $record): bool
    {
        if (empty($record['context']) || !isset($record['context']['exception'])) {
            return false;
        }

        return in_array(get_class($record['context']['exception']), $this->ignore);
    }

    private function ignoreCallStack(\Monolog\LogRecord $record): bool
    {
        if (empty($record['context']) || !isset($record['context']['exception'])) {
            return false;
        }

        return in_array(get_class($record['context']['exception']), $this->ignoreCallStack);
    }
}
