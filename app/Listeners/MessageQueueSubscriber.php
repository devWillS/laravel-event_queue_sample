<?php

namespace App\Listeners;

use App\Events\PublishProcessor;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MessageQueueSubscriber implements ShouldQueue
{
    public function handle(PublishProcessor $event)
    {
        \Log::info($event->getInt());
    }
}
