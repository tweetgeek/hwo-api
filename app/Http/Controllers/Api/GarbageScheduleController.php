<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\GarbageSchedulePostRequest;
use App\Repositories\PlaceRepository;
use App\Repositories\UserGarbageCollectionRepository;
use App\Repositories\UserGarbageScheduleRepository;
use DB;
use Illuminate\Http\JsonResponse;
use Request;

class GarbageScheduleController extends ApiController
{
    public function __construct(
        protected readonly UserGarbageScheduleRepository   $garbageScheduleRepository,
        protected readonly PlaceRepository                 $placeRepository,
        protected readonly UserGarbageCollectionRepository $userGarbageCollectionRepository,
    ) {
    }

    public function get(Request $request): JsonResponse
    {
        return $this->respondOk($this->garbageScheduleRepository->getFirst($request->user()));
    }

    public function post(GarbageSchedulePostRequest $request): JsonResponse
    {
        return DB::transaction(function () use ($request) {
            $place = $this->placeRepository->create($request->input('city'), $request->input('placeId'));
            $schedule = $this->garbageScheduleRepository->create($request->user(), $request->input('name'), $request->input('isPublic'), $place->id);
            $this->userGarbageCollectionRepository->create($schedule, $request->input('collectionsDates'));

            return $this->respondOk($this->garbageScheduleRepository->getById($request->user(), $schedule->id));
        });
    }
}
