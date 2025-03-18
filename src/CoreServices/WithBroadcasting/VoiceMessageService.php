<?php

namespace Omarabdulwahhab\Laramessenger\CoreServices\WithBroadcasting;

use Omarabdulwahhab\Laramessenger\Contracts\MessageType;
use Omarabdulwahhab\Laramessenger\CoreServices\ChatService;
use App\Events\SendMessageEvent;
use Omarabdulwahhab\Laramessenger\Helpers\FileUpload;
use App\Models\Message;

class VoiceMessageService implements MessageType
{

    public function handle($SenderID,$ReceiverID,$voice)
    {
        return $this->Prepare($SenderID,$ReceiverID,$voice);
    }

    private function Prepare($SenderID,$ReceiverID,$voice)
    {
        $ChatID = ChatService::PrepareChat($SenderID,$ReceiverID);
        $message = self::SaveMessageToDB(
            $ChatID,
            $SenderID,
            $ReceiverID,
            $voice
        );
        broadcast(new SendMessageEvent($message))->toOthers();
        return $message;
    }
    private static function SaveMessageToDB($ChatID, $SenderID, $ReceiverID ,$voice)
    {
        return Message::create([

            'from_user' => $SenderID,

            'to_user'   => $ReceiverID,

            'content'   => FileUpload::Upload($voice),

            'type'      => "voice",

            'chat_id'   => $ChatID,
        ]);
    }
}
