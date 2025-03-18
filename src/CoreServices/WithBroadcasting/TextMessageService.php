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
        return $this->Prepare($SenderID,$ReceiverID,$TextMessage);
    }

    private function Prepare($SenderID,$ReceiverID,$TextMessage)
    {
        $ChatID = ChatService::PrepareChat($SenderID,$ReceiverID);

        $message = self::SaveMessageToDB(
            $ChatID,
            $SenderID,
            $ReceiverID,
            $TextMessage
        );

        broadcast(new SendMessageEvent($message))->toOthers();
        return $message;
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
