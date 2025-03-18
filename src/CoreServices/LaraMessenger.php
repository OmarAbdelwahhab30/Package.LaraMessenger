<?php

namespace Omarabdulwahhab\Laramessenger\CoreServices;


class LaraMessenger
{
    public string $type;

    public mixed $message;
    public int|string $SenderID;
    public int|string $ReceiverID;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string|int
     */
    public function getSenderID(): string|int
    {
        return $this->SenderID;
    }

    /**
     * @return string|int
     */
    public function getReceiverID(): string|int
    {
        return $this->ReceiverID;
    }

    public static function builder(): LaraMessenger
    {
        return new LaraMessenger();
    }

    public function setSenderID($senderID): LaraMessenger
    {
        $this->SenderID = $senderID;
        return $this;
    }

    public function setReceiverID($receiverID): LaraMessenger
    {
        $this->ReceiverID = $receiverID;
        return $this;
    }

    public function setMessageType($type): LaraMessenger
    {
        $this->type = ucfirst(strtolower($type));
        return $this;
    }

    public function build(): LaraMessenger
    {
        return $this;
    }

    public function setMessage($message): LaraMessenger
    {
        $this->message = $message;
        return $this;
    }

    public function broadcast()
    {
        try {
            $CLASSNAME = 'Omarabdulwahhab\\Laramessenger\\CoreServices\\WithBroadcasting\\' . $this->type . 'MessageService';
            return (new $CLASSNAME)->handle($this->SenderID, $this->ReceiverID, $this->message);
        } catch (\Exception $exception) {
            return response()->json([
                "status" => $exception->getCode(),
                "message" => $exception->getMessage(),
            ]);
        }
    }

    public function send()
    {
        try {
            $CLASSNAME = 'Omarabdulwahhab\\Laramessenger\\CoreServices\\WithoutBroadcasting\\' . $this->type . 'MessageService';
            return (new $CLASSNAME)->handle($this->SenderID, $this->ReceiverID, $this->message);
        } catch (\Exception $exception) {
            return response()->json([
                "status" => $exception->getCode(),
                "message" => $exception->getMessage(),
            ]);
        }
    }
    
}
