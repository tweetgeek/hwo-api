<?php

namespace App\Repositories;

use App\Models\GarbageSchedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\Uuid;

class GarbageScheduleRepository
{
    public function getAll(User $user): Collection
    {
        return $user
            ->garbageSchedules()
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    public function getFirst(User $user): GarbageSchedule|null
    {
        return $user
            ->garbageSchedules()
            ->with('userGarbageCollections', fn ($query) => $query->where('date', '>=', Carbon::now()->format('Y-m-d')))
            ->with('userGarbageCollections.garbageType')
            ->orderBy('updated_at', 'desc')
            ->first();
    }

    public function getById(User $user, int $id): GarbageSchedule|null
    {
        return $user
            ->garbageSchedules()
            ->find($id);
    }

    public function create(User $user, string $name, bool $isPublic, string $placeId): GarbageSchedule
    {
        return $user
            ->garbageSchedules()
            ->create([
                GarbageSchedule::FIELD_NAME => $name,
                GarbageSchedule::FIELD_CODE => Uuid::uuid4(),
                GarbageSchedule::FIELD_IS_PUBLIC => $isPublic,
                GarbageSchedule::FIELD_PLACE_ID => $placeId,
            ]);
    }
}
