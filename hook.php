<?php

require __DIR__ . '/vendor/autoload.php';

try {
    $telegram = new Longman\TelegramBot\Telegram($_ENV['BOT_API_KEY'], $_ENV['BOT_USERNAME']);
    $telegram->handle();
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
     echo $e->getMessage();
}
