<?php

namespace App\Http\Controllers\Api;

use App\Repositories\GarbageTypeRepository;
use Illuminate\Http\JsonResponse;

class GarbageTypeController extends ApiController
{
    public function __construct(private readonly GarbageTypeRepository $garbageTypeRepository)
    {
    }

    public function get(): JsonResponse
    {
        return $this->respondOk($this->garbageTypeRepository->all());
    }
}
