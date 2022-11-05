<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class UserGarbageScheduleRepository
{
    public function getAll()
    {
        return Auth::user()
            ->userGarbageSchedules()
            ->orderBy('updated_at', 'desc')
            ->get();
    }

    public function getFirst()
    {
        return Auth::user()
            ->userGarbageSchedules()
            ->with('userGarbageCollections', fn ($query) => $query->where('date', '>=', Carbon::now()))
            ->with('userGarbageCollections.garbageType')
            ->orderBy('updated_at', 'desc')
            ->first();
    }

    public function create(string $name)
    {
        return Auth::user()
            ->userGarbageSchedules()
            ->create(['name' => $name, 'code' => Uuid::uuid4()]);
    }
}
