<?php

namespace Omarabdulwahhab\Laramessenger\Contracts;

interface MessageType
{
    public function handle($SenderID,$ReceiverID,$message);

}
