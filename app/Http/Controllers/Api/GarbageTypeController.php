<?php

namespace App\Http\Controllers\Api;

use App\Models\GarbageType;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class GarbageTypeController extends ApiController
{
    public function index(): JsonResponse
    {
        /** @var User $user */
        $user = \Auth::user();
        $sharedGarbageTypes = GarbageType::whereNull('user_id')->get();
        $types = $user->garbageTypes()->get();

        return response()->json([...$sharedGarbageTypes, ...$types]);
    }
}
