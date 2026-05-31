<?php

namespace App\MessageHandler;

use App\Message\Tracking;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class TrackingHandler
{
    public function __invoke(Tracking $message): void
    {
        // do something with your message
        //sleep(2);
    }
}
