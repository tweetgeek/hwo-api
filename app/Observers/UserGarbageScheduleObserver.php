<?php

namespace App\Observers;

use App\Models\User;
use App\Models\UserGarbageSchedule;

class UserGarbageScheduleObserver
{
    public function created(UserGarbageSchedule $userGarbageSchedule)
    {
        //todo add role to owner
        /** @var User $user */
        $user = $userGarbageSchedule->user;
        if (!$user->has_welcome_onboarding) {
            $user->userOnboarding()->create(['name' => 'welcome', 'value' => ['schedule_id' => $userGarbageSchedule->id]]);
        }

        $userGarbageSchedule->userGarbageScheduleRoles()->create([
            'user_id' => $user->id,
            'role' => 'owner'
        ]);
    }
}
