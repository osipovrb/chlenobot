<?php

use Longman\TelegramBot\TelegramLog;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

TelegramLog::initialize(
    // Main logger that handles all 'debug' and 'error' logs.
    new Logger('telegram_bot', [
        (new StreamHandler(__DIR__.'/logs/log.txt', Logger::DEBUG))->setFormatter(new LineFormatter(null, null, true)),
        (new StreamHandler(__DIR__.'/logs/log.txt', Logger::ERROR))->setFormatter(new LineFormatter(null, null, true)),
    ]),
    // Updates logger for raw updates.
    new Logger('telegram_bot_updates', [
        (new StreamHandler(__DIR__.'/logs/info.txt', Logger::INFO))->setFormatter(new LineFormatter('%message%' . PHP_EOL)),
    ])
);
