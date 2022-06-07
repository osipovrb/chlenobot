<?php

namespace App\Classes;

use Longman\TelegramBot\Entities\Message;

class MessageInfo
{
    public $chat_id;
    public $user_id;
    public $mention;

    /**
     * @param Message $message
     */
    public function __construct($message)
    {
        $this->chat_id = $message->getChat()->getId();
        $this->user_id = $message->getFrom()->getId();
        $this->mention = $message->getFrom()->tryMention();
    }
}
