<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserGarbageSchedule;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Ramsey\Uuid\Uuid;

class UserGarbageScheduleRepository
{
    public function getAll(User $user): Collection
    {
        return $user
            ->userGarbageSchedules()
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    public function getFirst(User $user): UserGarbageSchedule|null
    {
        return $user
            ->userGarbageSchedules()
            ->with('userGarbageCollections', fn ($query) => $query->where('date', '>=', Carbon::now()->format('Y-m-d')))
            ->with('userGarbageCollections.garbageType')
            ->orderBy('updated_at', 'desc')
            ->first();
    }

    public function getById(User $user, int $id): UserGarbageSchedule|null
    {
        return $user
            ->userGarbageSchedules()
            ->find($id);
    }

    public function create(User $user, string $name, bool $isPublic, string $placeId): UserGarbageSchedule
    {
        return $user
            ->userGarbageSchedules()
            ->create([
                UserGarbageSchedule::FIELD_NAME => $name,
                UserGarbageSchedule::FIELD_CODE => Uuid::uuid4(),
                UserGarbageSchedule::FIELD_IS_PUBLIC => $isPublic,
                UserGarbageSchedule::FIELD_PLACE_ID => $placeId,
            ]);
    }
}
