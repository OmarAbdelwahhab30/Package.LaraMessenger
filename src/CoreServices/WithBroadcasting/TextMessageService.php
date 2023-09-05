<?php

namespace Omarabdulwahhab\Laramessenger\CoreServices\WithBroadcasting;

use Omarabdulwahhab\Laramessenger\Contracts\MessageType;
use Omarabdulwahhab\Laramessenger\CoreServices\ChatService;
use App\Events\SendMessageEvent;
use App\Models\Message;

class TextMessageService implements MessageType
{
    public function handle($SenderID,$ReceiverID,$TextMessage)
    {
        $this->Prepare($SenderID,$ReceiverID,$TextMessage);
    }

    public function Prepare($SenderID,$ReceiverID,$TextMessage)
    {
        $ChatID = ChatService::PrepareChat($SenderID,$ReceiverID);
        broadcast(new SendMessageEvent(
            self::SaveMessageToDB(
                $ChatID,
                $SenderID,
                $ReceiverID,
                $TextMessage
            )
        ))->toOthers();
    }
    private static function SaveMessageToDB($ChatID, $SenderID, $ReceiverID ,$TextMessage = null)
    {
        return Message::create([

            'from_user' => $SenderID,

            'to_user'   => $ReceiverID,

            'content'   => $TextMessage,

            'type'      => "text",

            'chat_id'   => $ChatID,
        ]);
    }
}
