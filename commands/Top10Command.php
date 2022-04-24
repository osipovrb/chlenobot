<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Entities\User;

class Top10Command extends UserCommand
{
    protected $name = 'top10';
    protected $description = 'Топ 10 хуеносцев';
    protected $usage = '/top10';
    protected $version = '1.0';

    public function execute(): ServerResponse
    {
        $pdo = \Longman\TelegramBot\DB::getPdo();

        $message = $this->getMessage();

        $chatid = $message->getChat()->getId();
        $stmt = $pdo->prepare('SELECT mention, dicklen FROM dicks WHERE chatid = :chatid ORDER BY dicklen DESC LIMIT 10');
        $stmt->execute(compact('chatid'));
        $top10 = $stmt->fetchAll();

        $message = $top10
            ?   'Топ 10 хуеносцев:' . PHP_EOL . array_reduce($top10, fn($carry, $v) => $carry 
                    . (empty($v['mention']) ? 'Неизвестный шакал' : $v['mention']) . ': ' . $v['dicklen'] . ' см.' . PHP_EOL
                )
            :   'В этом чате писюны не найдены. Отправь /dick в чат чтобы вырастить член.';

        return $this->replyToChat($message);
    }
}
