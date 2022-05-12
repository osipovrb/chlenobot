<?php

namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Request;
use Carbon\Carbon;

class DickCommand extends UserCommand
{
    protected $name = 'dick';
    protected $description = 'Увеличить свой член';
    protected $usage = '/dick';
    protected $version = '1.0';

    public function execute(): ServerResponse
    {
        $pdo = \Longman\TelegramBot\DB::getPdo();

        $message = $this->getMessage();

        $chatid = $message->getChat()->getId();
        $userid = $message->getFrom()->getId();
        $mention = $message->getFrom()->tryMention();

        $stmt = $pdo->prepare('SELECT * FROM plays WHERE userid = :userid AND chatid = :chatid AND playdate = CURDATE()');
        $stmt->execute(compact('userid', 'chatid'));
        if ($stmt->fetchColumn()) { // сегодня уже играл
            Carbon::setLocale('ru');
            $comeAfter = Carbon::now()->endOfDay()->longRelativeToNowDiffForHumans($parts = 2);
            return $this->replyToChat($mention.', ты уже играл сегодня. Приходи ' . $comeAfter);
        } else {
            $stmt = $pdo->prepare('SELECT dicklen FROM dicks WHERE userid = :userid AND chatid = :chatid LIMIT 1');
            $stmt->execute(compact('userid', 'chatid'));
            $dicklen = $stmt->fetchColumn();

            if (!$dicklen) {
                $dicklen = 0;
                $stmt = $pdo->prepare('INSERT INTO dicks VALUES (:userid, :chatid, :dicklen, :mention)');
                $stmt->execute(compact('userid', 'chatid', 'dicklen', 'mention'));
            }
        
            do {
                $delta_plus = random_int(1, 10) > 2;
                $delta_dicklen = $delta_plus ? random_int(1, 10) : random_int(-10, -1);
                $new_dicklen = $dicklen + $delta_dicklen;
            } while ($new_dicklen < 0);

            $new_dicklen_msg = $delta_plus
                ? 'вырос на ' . $delta_dicklen. ' см.'
                : 'сократился на ' . abs($delta_dicklen) . ' см.';

            $stmt = $pdo->prepare('UPDATE dicks SET dicklen = :new_dicklen, mention = :mention WHERE userid = :userid AND chatid = :chatid');
            $stmt->execute(compact('new_dicklen', 'mention', 'userid', 'chatid'));

            $message = $mention . ', твой член ' . $new_dicklen_msg 
                . ' Теперь его длина: ' . $new_dicklen . ' см.';

            $stmt = $pdo->prepare('INSERT INTO plays VALUES (:userid, :chatid, CURDATE())');
            $stmt->execute(compact('userid', 'chatid'));

            return $this->replyToChat($message);
        }
    }
}
