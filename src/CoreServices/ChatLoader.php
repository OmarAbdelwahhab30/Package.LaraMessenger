<?php

namespace Omarabdulwahhab\Laramessenger\CoreServices;

use Omarabdulwahhab\Laramessenger\Contracts\Loader;
use App\Models\Chat;
use App\Models\Message;

class ChatLoader implements Loader
{

    public static function LoadChatByUsersID($FirstUserID,$SecondUserID)
    {
        try {
            return Message::where(function ($query) use ($FirstUserID,$SecondUserID) {
                $query->where('from_user', $FirstUserID)->where('to_user', $SecondUserID);
            })->orWhere(function ($query) use ($FirstUserID,$SecondUserID) {
                $query->where('from_user', $FirstUserID)->where('to_user',$SecondUserID);
            })->orderBy('created_at', 'ASC')->get();
        }catch (\Exception $exception){
            return response()->json([
                "status" => $exception->getCode(),
                "message"   => $exception->getMessage(),
            ]);
        }
    }

    public static function LoadChatByChatID($chat_id)
    {
        try {
            return Chat::where("id", $chat_id)->with(["messages" => function ($q) use ($chat_id) {
                $q->where("messages.chat_id",$chat_id)->orderBy("id", "asc");
            }])->get();
        }catch (\Exception $exception){
            return response()->json([
                "status" => $exception->getCode(),
                "message"   => $exception->getMessage(),
            ]);
        }
    }

    public static function LoadChatByScrolling($LatestMessageID,$FirstUserID,$SecondUserID,$no_messages = null)
    {
        try {
            $no_messages = $no_messages == null ? 10:$no_messages;
            $message = Message::find($LatestMessageID);
            $messages['Messages'] =  Message::where(function ($query) use ($FirstUserID,$SecondUserID,$message) {
                $query->where('from_user',$FirstUserID)
                    ->where('to_user', $SecondUserID)
                    ->where('created_at', '>', $message->created_at);
            })->orWhere(function ($query) use ($FirstUserID,$SecondUserID, $message) {
                $query->where('from_user', $SecondUserID)
                    ->where('to_user', $FirstUserID)
                    ->where('created_at', '>', $message->created_at);
            })->orderBy('created_at', 'ASC')->limit($no_messages)->get();
            $messages['LatestMessageID'] = $messages['Messages'][$no_messages - 1]['id'] ?? null;
            return $messages;
        }catch (\Exception $exception){
            return response()->json([
                "status" => $exception->getCode(),
                "message"   => $exception->getMessage(),
                ]);
        }
    }
}
