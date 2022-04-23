<?php

require __DIR__ . '/vendor/autoload.php';

try {
    $telegram = new Longman\TelegramBot\Telegram($_ENV['BOT_API_KEY'], $_ENV['BOT_USERNAME']);
    $result = $telegram->setWebhook($_ENV['BOT_HOOK_URL']);
    if ($result->isOk()) {
        echo $result->getDescription();
    }
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    echo $e->getMessage();
}
