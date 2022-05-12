<?php

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dotenv->required([
    'BOT_API_KEY', 
    'BOT_USERNAME', 
    'BOT_HOOK_URL', 
    'MYSQL_HOST', 
    'MYSQL_USERNAME', 
    'MYSQL_PASSWORD', 
    'MYSQL_DATABASE'
]);
