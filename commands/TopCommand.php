<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Request;

class TopCommand extends UserCommand
{
    protected $name = 'top';
    protected $description = 'Рейтинг хуеносцев';
    protected $usage = '/top';
    protected $version = '1.0';

    public function execute(): ServerResponse
    {
        return $this->replyToChat('Пока не реализовано, сорян. Скоро доделаю...');
    }
}
