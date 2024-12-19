<?php

namespace App\Logging;

use Monolog\Logger;

/**
* @phpstan-import-type Level from \Monolog\Logger
* @phpstan-import-type LevelName from \Monolog\Logger
*
 * @phpstan-type Config array{level: Level|LevelName|LogLevel::*}
 */
class TelegramLogger
{
/**
* @phpstan-param Config $config
*/
    public function __invoke(array $config): Logger
    {
        $telegramLoggerHandler = new TelegramLoggerHandler($config['level']);

        return new Logger(config('app.name'), [$telegramLoggerHandler]);
    }
}
