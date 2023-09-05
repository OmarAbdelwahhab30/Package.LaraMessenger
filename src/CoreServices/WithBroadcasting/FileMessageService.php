<?php

namespace Omarabdulwahhab\Laramessenger\CoreServices\WithBroadcasting;

use Omarabdulwahhab\Laramessenger\Contracts\MessageType;
use Omarabdulwahhab\Laramessenger\CoreServices\ChatService;
use App\Events\SendMessageEvent;
use Omarabdulwahhab\Laramessenger\Helpers\FileUpload;
use App\Models\Message;

class FileMessageService implements MessageType
{
    public function handle($SenderID,$ReceiverID,$File)
    {
        $this->Prepare($SenderID,$ReceiverID,$File);
    }

    private function Prepare($SenderID,$ReceiverID,$File)
    {
        $ChatID = ChatService::PrepareChat($SenderID,$ReceiverID);
        broadcast(new SendMessageEvent(
            self::SaveMessageToDB(
                $ChatID,
                $SenderID,
                $ReceiverID,
                $File
            )
        ))->toOthers();
    }
    private static function SaveMessageToDB($ChatID, $SenderID, $ReceiverID ,$File)
    {
        return Message::create([

            'from_user' => $SenderID,

            'to_user'   => $ReceiverID,

            'content'   => FileUpload::Upload($File),

            'type'      => "file",

            'chat_id'   => $ChatID,
        ]);
    }
}
