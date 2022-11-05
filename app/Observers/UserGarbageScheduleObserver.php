<?php

namespace App\Observers;

use App\Models\UserGarbageSchedule;

class UserGarbageScheduleObserver
{
    public function created(UserGarbageSchedule $userGarbageSchedule)
    {
        //todo add role to owner
    }
}
