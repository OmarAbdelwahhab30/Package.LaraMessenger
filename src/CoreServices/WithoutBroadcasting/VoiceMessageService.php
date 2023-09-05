<?php

namespace Omarabdulwahhab\Laramessenger\CoreServices\WithoutBroadcasting;

use Omarabdulwahhab\Laramessenger\Contracts\MessageType;
use Omarabdulwahhab\Laramessenger\CoreServices\ChatService;
use Omarabdulwahhab\Laramessenger\Events\SendMessageEvent;
use Omarabdulwahhab\Laramessenger\Helpers\FileUpload;
use App\Models\Message;

class VoiceMessageService implements MessageType
{

    public function handle($SenderID,$ReceiverID,$voice)
    {
        $this->Prepare($SenderID,$ReceiverID,$voice);
    }

    private function Prepare($SenderID,$ReceiverID,$voice)
    {
        $ChatID = ChatService::PrepareChat($SenderID,$ReceiverID);
            self::SaveMessageToDB(
                $ChatID,
                $SenderID,
                $ReceiverID,
                $voice
            );
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
