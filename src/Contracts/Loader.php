<?php

namespace Omarabdulwahhab\Laramessenger\Contracts;


interface Loader
{
    public static function LoadChatByUsersID(
        int|string $FirstUserID,
        int|string $SecondUserID,
        string $sort = 'DESC'
    );
    public static function LoadChatByChatID(
        int|string $chatID,
        string $sort = 'DESC'
    );
    public static function LoadChatByScrolling(
        int|string $FirstUserID, int|string $SecondUserID, $LatestMessageID = null, $no_messages = null);
}
