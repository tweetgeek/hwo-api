<?php

namespace App\Http\Controllers\Api;

use App\Repositories\UserGarbageCollectionRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GarbageCollectionController extends ApiController
{
    public function __construct(protected readonly UserGarbageCollectionRepository $userGarbageCollectionRepository)
    {
    }

    public function get(Request $request): JsonResponse
    {
        $collections = $request->query('future')
            ? $this->userGarbageCollectionRepository->getAllFuture()
            : $this->userGarbageCollectionRepository->getAll();

        return $this->respondOk($collections);
    }
}
