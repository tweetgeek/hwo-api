<?php

namespace App\Listeners;

use App\Events\OnboardingCreatedEvent;
use App\Models\UserOnboarding;

class UserOnboardingCreatedListener
{
    public function handle(OnboardingCreatedEvent $event): void
    {
        if ($event->userOnboarding->name === UserOnboarding::ONBOARDING_WELCOME && !$event->user->userNotificationSetting) {
            $event->user->userNotificationSetting()->create();
        }
    }
}
