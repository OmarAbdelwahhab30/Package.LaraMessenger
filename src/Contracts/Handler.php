<?php

namespace Omarabdulwahhab\Laramessenger\Contracts;


interface Handler
{
    public static function editMessage(string|int $messageId, string $newText);

    public static function deleteMessage(string|int $messageId);

    public static function deleteMessages(array $messagesIds = []);

}
