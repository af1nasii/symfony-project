<?php

namespace App\Factory;

use App\Entity\Message;

class MessageFactory
{
    public function create(string $content): Message
    {
        $message = new Message();
        $message->setContent($content);

        return $message;
    }
}