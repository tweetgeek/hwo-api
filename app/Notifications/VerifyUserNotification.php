<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\HtmlString;

class VerifyUserNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(private readonly string $code)
    {

    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        // TODO use template
        return (new MailMessage())
            ->subject("Weryfikacja konta - Harmonogram Wywozu Odpadów")
            ->greeting('Cześć!')
            ->line("Twój kod do weryfikacji w aplikacji")
            ->line(new HtmlString("<strong style='font-weight: 900;letter-spacing: 10px;'>$this->code</strong>"))
            ->line(Lang::get('If you did not create an account, no further action is required.'));
    }
}
