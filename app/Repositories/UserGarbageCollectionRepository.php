<?php

namespace App\Repositories;

use App\Models\GarbageType;
use App\Models\User;
use App\Models\UserGarbageCollection;
use App\Models\UserGarbageSchedule;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\CursorPaginator;

class UserGarbageCollectionRepository
{
    public const ITEMS_PER_PAGE = 15;

    public function getAll(User $user): CursorPaginator
    {
        return UserGarbageCollection::whereHas('userGarbageSchedule', static fn ($query) => $query->where('user_garbage_schedules.user_id', $user->id))
            ->with('userGarbageSchedule')
            ->with('garbageType')
            ->orderBy('date', 'asc')
            ->cursorPaginate(self::ITEMS_PER_PAGE);
    }

    public function getAllFuture(User $user): CursorPaginator
    {
        return UserGarbageCollection::whereHas('userGarbageSchedule', static fn ($query) => $query->where('user_garbage_schedules.user_id', $user->id))
            ->with('userGarbageSchedule')
            ->with('garbageType')
            ->where('date', '>=', Carbon::now()->format('Y-m-d'))
            ->orderBy('date', 'asc')
            ->cursorPaginate(self::ITEMS_PER_PAGE);
    }

    public function create(UserGarbageSchedule $schedule, array $collectionsDates): void
    {
        foreach ($collectionsDates as $typeId => $collectionsDate) {
            $type = GarbageType::findOrFail($typeId);
            foreach ($collectionsDate as $date) {
                if (empty($date)) {
                    return;
                }
                $schedule->userGarbageCollections()->firstOrCreate([
                    UserGarbageCollection::FIELD_USER_GARBAGE_SCHEDULE_ID => $schedule->id,
                    UserGarbageCollection::FIELD_GARBAGE_TYPE_ID => $type->id,
                    UserGarbageCollection::FIELD_DATE => $date,
                ]);
            }
        }
    }
}
