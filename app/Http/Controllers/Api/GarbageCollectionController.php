<?php

namespace App\Http\Controllers\Api;

use App\Repositories\GarbageCollectionRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GarbageCollectionController extends ApiController
{
    public function __construct(protected readonly GarbageCollectionRepository $userGarbageCollectionRepository)
    {
    }

    public function get(Request $request): JsonResponse
    {
        $user = $request->user();
        $collections = $request->query('future')
            ? $this->userGarbageCollectionRepository->getAllFuture($user)
            : $this->userGarbageCollectionRepository->getAll($user);

        return $this->respondOk($collections);
    }
}
