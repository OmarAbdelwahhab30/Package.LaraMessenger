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
        return $this->Prepare($SenderID,$ReceiverID,$File);
    }

    private function Prepare($SenderID,$ReceiverID,$File)
    {
        $ChatID = ChatService::PrepareChat($SenderID,$ReceiverID);
        $message = self::SaveMessageToDB(
            $ChatID,
            $SenderID,
            $ReceiverID,
            $File
        );
        broadcast(new SendMessageEvent($message))->toOthers();
        return $message;
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
