<?php

namespace App\Repositories;

use App\Models\Place;
use Illuminate\Database\Eloquent\Collection;

class PlaceRepository
{
    public function getAll(): Collection
    {
        return Place::get();
    }

    public function create(string $name, string $placeId): Place
    {
        return Place::firstOrCreate([
            Place::FIELD_ID => $placeId,
            Place::FIELD_NAME => $name,
        ]);
    }
}
