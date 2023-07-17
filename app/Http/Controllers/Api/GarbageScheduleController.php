<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\GarbageSchedulePostRequest;
use App\Repositories\UserGarbageScheduleRepository;
use Illuminate\Http\JsonResponse;
use Request;

class GarbageScheduleController extends ApiController
{
    public function __construct(protected readonly UserGarbageScheduleRepository $garbageScheduleRepository)
    {
    }

    public function get(Request $request): JsonResponse
    {
        return $this->respondOk($this->garbageScheduleRepository->getFirst($request->user()));
    }

    public function post(GarbageSchedulePostRequest $request): JsonResponse
    {
        return $this->respondOk($this->garbageScheduleRepository->create($request->user(), $request->input('name')));
    }
}
