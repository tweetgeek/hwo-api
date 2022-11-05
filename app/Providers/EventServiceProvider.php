<?php

namespace App\Providers;

use App\Events\OnboardingCreatedEvent;
use App\Listeners\SendVerificationCodeToRegisteredUserListener;
use App\Listeners\UserOnboardingCreatedListener;
use App\Models\UserGarbageSchedule;
use App\Observers\UserGarbageScheduleObserver;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
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
            SendVerificationCodeToRegisteredUserListener::class,
        ],
        Login::class => [
        ],
        Logout::class => [
        ],
        OnboardingCreatedEvent::class => [
            UserOnboardingCreatedListener::class
        ]
    ];

    protected $observers = [
        UserGarbageSchedule::class => [UserGarbageScheduleObserver::class],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
