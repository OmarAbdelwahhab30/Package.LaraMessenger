<?php

namespace Omarabdulwahhab\Laramessenger\CoreServices;

use App\Http\Controllers\Controller;
use App\Models\Chat;

class ChatService extends Controller
{

    public static function PrepareChat($SenderID,$ReceiverID)
    {
        try {
            return !ChatService::IsTherePreviousChat($SenderID, $ReceiverID) ?
                ChatService::createNewChat($SenderID,$ReceiverID)
                :
                ChatService::IsTherePreviousChat($SenderID,$ReceiverID);
        }catch (\Exception $exception){
            return response()->json([
                "status" => $exception->getCode(),
                "message"   => $exception->getMessage(),
            ]);
        }
    }
    private static function IsTherePreviousChat($sender,$receiver)
    {

        try {
            $collection = Chat::where(['first_user' => $sender,'second_user' => $receiver])
                ->orWhere(['first_user' => $receiver,'second_user' => $sender ])->first();
            if (!empty($collection))
            {
                return $collection->id;
            }
            return false;
        }catch (\Exception $exception){
            return response()->json([
                "status" => $exception->getCode(),
                "message"   => $exception->getMessage(),
            ]);
        }
    }

    private static function createNewChat($sender,$to_user)
    {
        try {
            return Chat::create([
                'first_user' => $sender,
                'second_user' => $to_user,
            ])->id;
        }catch (\Exception $exception){
            return response()->json([
                "status" => $exception->getCode(),
                "message"   => $exception->getMessage(),
            ]);
        }
    }
}
