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

        if ($top10) {
            $top10 = $this->makePlayersMentionTagless($top10);
            $message = 'Топ 10 хуеносцев: ' . PHP_EOL . $this->makePlayersList($top10);
        } else {
            $message = 'В этом чате писюны не найдены. Отправь /dick в чат чтобы вырастить член.';
        }

        return $this->replyToChat($message);
    }

    private function makePlayersMentionTagless($players) {
        foreach ($players as &$player) { 
            if (preg_match('/^@/', $player['mention'])) {
                $player['mention'] = substr($player['mention'], 1);
            }
        }
        
        return $players;
    }

    private function makePlayersList($players) {
        $place = 0;
        return array_reduce($players, function($carry, $v) use (&$place) {
            $place++;
            return $carry . $place . '. ' .$v['mention'] . ': ' . $v['dicklen'] . ' см.' . PHP_EOL;
        });
    }
}
