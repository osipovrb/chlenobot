<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Request;

class StartCommand extends UserCommand
{
    protected $name = 'start';
    protected $description = 'Start command';
    protected $usage = '/start';
    protected $version = '1.2.0';

    public function execute(): ServerResponse
    {
        return $this->replyToChat('I am alive!');
    }
}
