<?php

namespace App\Broadcasting;

use App\Exceptions\CouldNotSendNotificationException;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Notifications\Notification;

class ExpoChannel
{
    /**
     * The Http Client.
     * @var Client
     */
    protected $client;

    /**
     * Initialise a new Expo Push Channel instance.
     *
     * @param Client $client
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param Notification $notification
     *
     * @throws CouldNotSendNotificationException|GuzzleException
     */
    public function send($notifiable, Notification $notification)
    {
        if (!($to = $notifiable->routeNotificationFor('expo'))) {
            throw CouldNotSendNotificationException::noValidDestination($notifiable);
        }

        if (!method_exists($notification, 'toExpo')) {
            throw CouldNotSendNotificationException::undefinedMethod($notification);
        }

        /** @var ExpoMessage $message */
        if (!($message = $notification->toExpo($notification)) instanceof ExpoMessage) {
            throw CouldNotSendNotificationException::couldNotCreateMessage($notification);
        }

        if (!is_array($to)) {
            $to = [$to];
        }

        $messages = array_map(
            function ($recipient) use ($message) {
                return array_merge(['to' => $recipient], $message->toArray());
            },
            $to
        );

        try {
            $response = $this->client->request(
                'post',
                'https://exp.host/--/api/v2/push/send',
                ['json' => $messages]
            );

            if ($response->getStatusCode() !== 200) {
                throw CouldNotSendNotificationException::serviceRespondedWithAnError($response);
            }

            return $response;
        } catch (ClientException $exception) {
            throw CouldNotSendNotificationException::clientError($exception);
        } catch (Exception $exception) {
            throw CouldNotSendNotificationException::unexpectedException($exception);
        }
    }
}
