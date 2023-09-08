<?php

namespace App\Http\Controllers\Api;

use App\Repositories\GarbageScheduleRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GarbageSchedulesController extends ApiController
{
    public function __construct(protected readonly GarbageScheduleRepository $garbageScheduleRepository)
    {
    }

    public function get(Request $request): JsonResponse
    {
        return $this->respondOk($this->garbageScheduleRepository->getAll($request->user()));
    }
}
