<?php

namespace App\Repositories;

use App\Models\GarbageType;
use Illuminate\Database\Eloquent\Collection;

class GarbageTypeRepository
{
    public function all(): Collection
    {
        return GarbageType::all();
    }
}
