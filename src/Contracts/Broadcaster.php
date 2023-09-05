<?php

namespace Omarabdulwahhab\Laramessenger\Contracts;

use Ramsey\Uuid\Type\Integer;

interface Broadcaster
{
    public function SendMessageWithBroadCast($message);
    public function SendMessageWithoutBroadCast($message);
}
