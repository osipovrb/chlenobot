<?php

namespace App\Commands;

use App\Classes\MessageInfo;
use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;

class AbstractCommand extends UserCommand
{
    public function execute(): ServerResponse
    {
        return $this->replyToChat('Какая-то ошибка');
    }

    public function getMessageInfo()
    {
        return new MessageInfo($this->getMessage());
    }
}
