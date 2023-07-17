<?php

namespace App\Http\Controllers\Api;

use App\Repositories\UserGarbageScheduleRepository;
use Illuminate\Http\JsonResponse;
use Request;

class GarbageSchedulesController extends ApiController
{
    public function __construct(protected readonly UserGarbageScheduleRepository $garbageScheduleRepository)
    {
    }

    public function get(Request $request): JsonResponse
    {
        return $this->respondOk($this->garbageScheduleRepository->getAll($request->user()));
    }
}
