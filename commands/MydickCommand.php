<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Entities\User;

class MydickCommand extends UserCommand
{
    protected $name = 'mydick';
    protected $description = 'Посмотреть длину своего члена';
    protected $usage = '/mydick';
    protected $version = '1.0';

    public function execute(): ServerResponse
    {
        $pdo = \Longman\TelegramBot\DB::getPdo();

        $message = $this->getMessage();
        $chatid = $message->getChat()->getId();
        $userid = $message->getFrom()->getId();
        $mention = $message->getFrom()->tryMention();

        $stmt = $pdo->prepare('SELECT mention, dicklen FROM dicks WHERE chatid = :chatid AND userid = :userid LIMIT 1');
        $stmt->execute(compact('chatid', 'userid'));
        $dick = $stmt->fetch();

        $message = ($dick) 
            ?  $mention . ', длина твоего члена: ' . $dick['dicklen'] . ' см.'
            :  $mention . ', не нашел твой писюн. Отправь /dick в чат чтобы вырастить себе большой и могучий член.'.$dick;

        return $this->replyToChat($message);
    }
}
