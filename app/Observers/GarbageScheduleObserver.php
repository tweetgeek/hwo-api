<?php

namespace App\Observers;

use App\Models\GarbageSchedule;
use App\Models\User;

class GarbageScheduleObserver
{
    public function created(GarbageSchedule $userGarbageSchedule)
    {
        // TODO
        /** @var User $user */
        //        $user = $userGarbageSchedule->user;
        //        if (!$user->has_welcome_onboarding) {
        //            $userOnboarding = $user->userOnboarding()->create(['name' => 'welcome', 'value' => ['schedule_id' => $userGarbageSchedule->id]]);
        //            event(new OnboardingCreatedEvent($user, $userOnboarding));
        //        }

        //        $userGarbageSchedule->userGarbageScheduleRoles()->create([
        //            'user_id' => $user->id,
        //            'role' => 'owner'
        //        ]);
    }
}
