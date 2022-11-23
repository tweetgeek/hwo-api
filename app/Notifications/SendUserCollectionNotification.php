<?php

namespace App\Notifications;

use App\Broadcasting\ExpoChannel;
use App\Broadcasting\ExpoMessage;
use App\Models\User;
use App\Models\UserGarbageCollection;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Channels\DatabaseChannel;
use Illuminate\Notifications\Channels\MailChannel;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Collection;

class SendUserCollectionNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private string $collectionsList;

    public function __construct(private readonly Collection $collections)
    {
        $this->collectionsList = $collections->map(function (UserGarbageCollection $collection) {
            return $collection->garbageType->name;
        })->unique()->join(', ');
    }

    public function via(User $notifiable): array
    {
        $via = [DatabaseChannel::class];
        $settings = $notifiable->userNotificationSetting;
        if ($settings->send_to_app && $notifiable->userDevices()->whereNotNull('push_token')->exists()) {
            $via[] = ExpoChannel::class;
        }
        if ($settings->send_to_email) {
            $via[] = MailChannel::class;
        }
        return $via;
    }

    public function toMail($notifiable): MailMessage
    {
        $message = (new MailMessage())
            ->subject('Harmonogram Wywozu Odpadów przypomina');

        $this->collections->unique('garbageType.name')->each(function (UserGarbageCollection $collection) use ($message) {
            $message->line("[{$collection->garbageType->icon}] {$collection->garbageType->name}");
        });

        return $message;
    }

    public function toExpo($notifiable): ExpoMessage
    {
        return ExpoMessage::create()
            ->badge($this->collections->count())
            ->enableSound()
            ->title("Harmonogram Wywozu Odpadów przypomina")
            ->body("Jutro wywóz: $this->collectionsList");
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
