<?php

use App\Database\DB;

require __DIR__ . '/vendor/autoload.php';

try {
    $telegram = new Longman\TelegramBot\Telegram($_ENV['BOT_API_KEY'], $_ENV['BOT_USERNAME']);
    
    $telegram->addCommandsPaths([
        __DIR__ . '/src/Commands/',
    ]);

    $db = DB::getInstance();
    $db->initialize();
    
    //This prevents library from processing repetitive requests
    $telegram->enableLimiter();
    
    //#3- A database for the library
    $mysql_credentials = [
        'host'     => $_ENV['MYSQL_HOST'],
        'user'     => $_ENV['MYSQL_USERNAME'],
        'password' => $_ENV['MYSQL_PASSWORD'],
        'database' => $_ENV['MYSQL_DATABASE'],
    ];
    
    $telegram->enableMySql($mysql_credentials);

    $telegram->handle();
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
     echo $e->getMessage();
}
