<?php

namespace Omarabdulwahhab\Laramessenger\CoreServices;


use App\Models\Message;
use Mockery\Exception;
use Omarabdulwahhab\Laramessenger\Contracts\Handler;

class MessageManager implements Handler
{

    public static function editMessage($messageId, $newText): bool
    {
        try {

            $message = Message::where('type', 'text')->where('id', $messageId)->first();
            $message->content = $newText;
            if ($message->save()) {
                return true;
            }
            return false;

        } catch (\Exception $exception) {
            return response()->json([
                'status' => $exception->getCode(),
                'message' => $exception->getMessage(),
            ]);
        }
    }

    public static function deleteMessage($messageId): bool
    {
        try {

            $message = Message::find($messageId);
            if ($message->delete()) {
                return true;
            }
            return false;

        } catch (\Exception $exception) {
            return response()->json([
                'status' => $exception->getCode(),
                'message' => $exception->getMessage(),
            ]);
        }
    }

    public static function deleteMessages($messagesIds = [])
    {
        try {

            $bool = Message::destroy($messagesIds);
            if ($bool) {
                return true;
            }
            return false;

        } catch (\Exception $exception) {
            return response()->json([
                'status' => $exception->getCode(),
                'message' => $exception->getMessage(),
            ]);
        }
    }
}
