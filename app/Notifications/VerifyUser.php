<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;
use Vinkla\Hashids\Facades\Hashids;

class VerifyUser extends Notification
{
    public function via(mixed $notifiable): array|string
    {
        return ['mail'];
    }

    public function toMail(User $notifiable): MailMessage
    {
        $code = Hashids::connection('code')->encode($notifiable->getKey());
        $notifiable->userVerificationCode()->create(['code' => $code]);

        return $this->buildMailMessage($code);
    }

    protected function buildMailMessage(string $code): MailMessage
    {
        return(new MailMessage())
            ->view('emails.verify_account', ['code' => $code])
            ->subject(config('app.name') . ' - ' . Lang::get('Weryfikacja konta'));
    }
}
