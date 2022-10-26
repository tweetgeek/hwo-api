<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;

class SendVerificationCodeToRegisteredUserListener
{
    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event): void
    {
        if (!$event->user->isVerified()) {
            $event->user->sendVerificationCodeNotification();
        }
    }
}
