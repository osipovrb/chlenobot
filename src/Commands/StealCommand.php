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

        $played = $db->medoo->get('plays', 'steal_date', [
            'userid' => $messageInfo->user_id,
            'chatid' => $messageInfo->chat_id,
            'steal_date' => Medoo::raw('CURDATE()'),
        ]);

        if ($played) {
            return $this->replyToChat($messageInfo->mention.', ты уже воровал сегодня член!');
        }
    }
}
