<?php

namespace App\Commands;

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

        $stmt = $pdo->prepare(' SELECT * 
                                FROM (
                                    SELECT userid, mention, dicklen, ROW_NUMBER() OVER(ORDER BY dicklen DESC) as rating 
                                    FROM dicks 
                                    WHERE chatid = :chatid
                                ) t    
                                WHERE userid = :userid;');

        $stmt->execute(compact('chatid', 'userid'));
        $dick = $stmt->fetch();

        $message = ($dick) 
            ?  $mention . ', длина твоего члена: ' . $dick['dicklen'] . ' см. Ты занимаешь ' . $dick['rating'] . ' место в рейтинге.'
            :  $mention . ', не нашел твой писюн. Отправь /dick в чат чтобы вырастить член.';

        return $this->replyToChat($message);
    }
}
