<?php

namespace App\Listeners;

use App\Notifications\UserRegisteredNotification;
use Illuminate\Auth\Events\Registered;

class SendUserRegisteredNotificationListener
{
    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event): void
    {
        $event->user->notify(new UserRegisteredNotification());
    }
}
