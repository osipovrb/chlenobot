<?php

namespace App\Commands;

use App\Database\DB;
use Longman\TelegramBot\Entities\ServerResponse;
use Medoo\Medoo;

class StealCommand extends AbstractCommand
{
    protected $name = 'steal';
    protected $description = 'Своровать член';
    protected $usage = '/steal';
    protected $version = '1.0';

    public function execute(): ServerResponse
    {
        $db = DB::getInstance();

        $messageInfo = $this->getMessageInfo();

        /*$played = $db->medoo->get('plays', 'steal_date', [
            'userid' => $messageInfo->user_id,
            'chatid' => $messageInfo->chat_id,
            'steal_date' => Medoo::raw('CURDATE()'),
        ]);

        if ($played) {
            return $this->replyToChat($messageInfo->mention . ', ты уже воровал сегодня член!');
        }

        $longestDick = $db->medoo->get(
            'dicks',
            ['dicklen', 'mention', 'userid'],
            [
                'chatid' => $messageInfo->chat_id,
                'ORDER' => [
                    'dicklen' => 'DESC'
                ],
            ]
        );

        if ((int)$longestDick['userid'] === $messageInfo->user_id) {
            return $this->replyToChat('У тебя самый длинный член, ты не можешь воровать!');
        }

        $myDick = $db->medoo->get(
            'dicks',
            'dicklen',
            [
                'chatid' => $messageInfo->chat_id,
                'userid' => $messageInfo->user_id,
            ]
        );

        $delta = random_int(1, 5);

        $db->medoo->update('dicks', [
            'dicklen' => $longestDick['dicklen'] - $delta,
        ], [
            'chatid' => $messageInfo->chat_id,
            'userid' => $longestDick['userid'],
        ]);

        $db->medoo->update('dicks', [
            'dicklen' => $myDick + $delta,
        ], [
            'chatid' => $messageInfo->chat_id,
            'userid' => $messageInfo->user_id,
        ]);

        $db->medoo->update('plays', [
            'steal_date' => Medoo::raw('CURDATE()')
        ], [
            'chatid' => $messageInfo->chat_id,
            'userid' => $messageInfo->user_id,
        ]);

        $longestMention = $longestDick['mention'];

        return $this->replyToChat(
            "$messageInfo->mention, ты украл у $longestMention $delta см члена!"
        );*/

        return $this->replyToChat(
            "Команда не работает, потому что Карась не заплатил алименты!"
        );
    }
}
