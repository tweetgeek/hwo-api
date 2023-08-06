<?php

namespace App\Observers;

use App\Events\OnboardingCreatedEvent;
use App\Models\User;
use App\Models\UserGarbageSchedule;

class UserGarbageScheduleObserver
{
    public function created(UserGarbageSchedule $userGarbageSchedule)
    {
        /** @var User $user */
        $user = $userGarbageSchedule->user;
        if (!$user->has_welcome_onboarding) {
            $userOnboarding = $user->userOnboarding()->create(['name' => 'welcome', 'value' => ['schedule_id' => $userGarbageSchedule->id]]);
            event(new OnboardingCreatedEvent($user, $userOnboarding));
        }

        $userGarbageSchedule->userGarbageScheduleRoles()->create([
            'user_id' => $user->id,
            'role' => 'owner'
        ]);
    }
}
