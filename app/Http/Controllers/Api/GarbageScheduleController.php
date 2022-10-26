<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class GarbageScheduleController extends ApiController
{
    public function get(): JsonResponse
    {
        /** @var User $user */
        $user = \Auth::user();

        $schedule = $user->garbageSchedules()
            ->with('availableGarbageCollections')
            ->with('availableGarbageCollections.garbageType')
            ->first();

        return response()->json($schedule);
    }
}
