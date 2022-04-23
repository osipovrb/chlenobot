<?php

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dotenv->required(['BOT_API_KEY', 'BOT_USERNAME', 'BOT_HOOK_URL']);
