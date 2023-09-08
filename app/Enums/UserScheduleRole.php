<?php

namespace App\Enums;

enum UserScheduleRole: string
{
    case OWNER = 'owner';
    case VIEWER = 'viewer';
}
