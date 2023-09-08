<?php

namespace App\Repositories;

use App\Models\GarbageCollection;
use App\Models\GarbageSchedule;
use App\Models\GarbageType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\CursorPaginator;

class GarbageCollectionRepository
{
    public const ITEMS_PER_PAGE = 15;

    public function getAll(User $user): CursorPaginator
    {
        return $user->garbageSchedules()->with('garbageCollections', fn ($query) => $query->orderBy('date', 'asc'))
            ->with('garbageCollections.garbageType')
            ->cursorPaginate(self::ITEMS_PER_PAGE);


        return GarbageCollection::whereHas('userGarbageSchedule', static fn ($query) => $query->where('user_garbage_schedules.user_id', $user->id))
            ->with('userGarbageSchedule')
            ->with('garbageType')
            ->orderBy('date', 'asc')
            ->cursorPaginate(self::ITEMS_PER_PAGE);
    }

    public function getAllFuture(User $user): CursorPaginator
    {
        return $user->garbageSchedules()->with('garbageCollections', fn ($query) => $query->where('date', '>=', Carbon::now()->format('Y-m-d'))->orderBy('date', 'asc'))
            ->with('garbageCollections.garbageType')
            ->cursorPaginate(self::ITEMS_PER_PAGE);

        return GarbageCollection::whereHas('userGarbageSchedule', static fn ($query) => $query->where('user_garbage_schedules.user_id', $user->id))
            ->with('userGarbageSchedule')
            ->with('garbageType')
            ->where('date', '>=', Carbon::now()->format('Y-m-d'))
            ->orderBy('date', 'asc')
            ->cursorPaginate(self::ITEMS_PER_PAGE);
    }

    public function create(GarbageSchedule $schedule, array $collectionsDates): void
    {
        foreach ($collectionsDates as $typeId => $collectionsDate) {
            $type = GarbageType::findOrFail($typeId);
            foreach ($collectionsDate as $date) {
                if (empty($date)) {
                    return;
                }
                $schedule->garbageCollections()->firstOrCreate([
                    GarbageCollection::FIELD_USER_GARBAGE_SCHEDULE_ID => $schedule->id,
                    GarbageCollection::FIELD_GARBAGE_TYPE_ID => $type->id,
                    GarbageCollection::FIELD_DATE => $date,
                ]);
            }
        }
    }
}
