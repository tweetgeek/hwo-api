<?php

namespace App\Http\Controllers\Api;

use App\Repositories\UserGarbageScheduleRepository;
use Illuminate\Http\JsonResponse;

class GarbageSchedulesController extends ApiController
{
    public function __construct(protected readonly UserGarbageScheduleRepository $garbageScheduleRepository)
    {
    }

    public function get(): JsonResponse
    {
        return $this->respondOk($this->garbageScheduleRepository->getAll());
    }
}
