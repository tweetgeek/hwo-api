<?php

namespace App\Providers;

use App\Events\OnboardingCreatedEvent;
use App\Listeners\CreateUserSettingsAfterOnboarding;
use App\Models\UserGarbageSchedule;
use App\Observers\UserGarbageScheduleObserver;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
//            SendVerificationCodeToRegisteredUserListener::class,
        ],
        Login::class => [
        ],
        OnboardingCreatedEvent::class => [
            CreateUserSettingsAfterOnboarding::class
        ]
    ];
    protected $observers = [
        UserGarbageSchedule::class => [UserGarbageScheduleObserver::class],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
