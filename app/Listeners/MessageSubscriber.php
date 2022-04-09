<?php

namespace App\Listeners;

use App\Events\PublishProcessor;

class MessageSubscriber
{
    public function handle(PublishProcessor $event)
    {
        var_dump($event->getInt());
    }
}
