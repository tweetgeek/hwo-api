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
            ->with('userGarbageCollections', fn ($query) => $query->where('date', '>=', Carbon::now()))
            ->with('userGarbageCollections.garbageType')
            ->orderBy('updated_at', 'desc')
            ->first();
    }

    public function create(User $user, string $name): UserGarbageSchedule
    {
        return $user
            ->userGarbageSchedules()
            ->create(['name' => $name, 'code' => Uuid::uuid4()]);
    }
}
