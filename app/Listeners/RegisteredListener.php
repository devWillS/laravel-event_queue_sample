<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RegisteredListener
{
    public function handle(Registered $event)
    {
        dispatch(new SendRegistMail($event->user->email))
            ->onQueue('mail')
            ->delay(now()->addHour(1));
    }
}
