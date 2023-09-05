<?php

namespace Omarabdulwahhab\Laramessenger\Contracts;


interface Loader
{
    public static function LoadChatByUsersID(
        int|string $FirstUserID,
        int|string $SecondUserID
    );
    public static function LoadChatByChatID(
        int|string $chatID
    );
    public static function LoadChatByScrolling(int|string $LatestMessageID,
                                               int|string $FirstUserID,
                                               int|string $SecondUserID,
                                        $no_messages = null
    );
}
