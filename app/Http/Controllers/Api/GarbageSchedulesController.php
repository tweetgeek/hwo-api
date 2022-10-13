<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\GarbageScheduleStoreRequest;
use App\Models\GarbageSchedule;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;

class GarbageSchedulesController extends ApiController
{
    public function index(): JsonResponse
    {
        /** @var User $user */
        $user = \Auth::user();
        $schedules = GarbageSchedule::whereNull('user_id')->orWhere('user_id', $user->id)->get();

        return response()->json(['data' => $schedules]);
    }

    public function store(GarbageScheduleStoreRequest $request): JsonResponse
    {
        $schedule = new GarbageSchedule();
        $schedule->name = $request->input('name');
        $schedule->code = Uuid::uuid4();
        $schedule->user_id = \Auth::user()->id;
        $schedule->save();

        return response()->json($schedule);
    }

    public function show($id): JsonResponse|Response
    {
        $schedule = GarbageSchedule::find($id);

        if (!$schedule) {
            return response()->noContent(Response::HTTP_NOT_FOUND);
        }

        return response()->json($schedule);
    }
}
