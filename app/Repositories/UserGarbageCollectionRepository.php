<?php

namespace App\Repositories;

use App\Models\UserGarbageCollection;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\CursorPaginator;

class UserGarbageCollectionRepository
{
    public const ITEMS_PER_PAGE = 15;
    public function getAll(): CursorPaginator
    {
        return UserGarbageCollection::whereHas('userGarbageSchedule', static fn ($query) => $query->where('user_garbage_schedules.user_id', \Auth::user()->id))
            ->with('userGarbageSchedule')
            ->with('garbageType')
            ->orderBy('date', 'asc')
            ->cursorPaginate(self::ITEMS_PER_PAGE);
    }

    public function getAllFuture(): CursorPaginator
    {
        return UserGarbageCollection::whereHas('userGarbageSchedule', static fn ($query) => $query->where('user_garbage_schedules.user_id', \Auth::user()->id))
            ->with('userGarbageSchedule')
            ->with('garbageType')
            ->where('date', '>=', Carbon::now())
            ->orderBy('date', 'asc')
            ->cursorPaginate(self::ITEMS_PER_PAGE);
    }
}
