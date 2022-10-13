<?php

namespace App\Models;

use Database\Factories\GarbageCollectionFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GarbageCollection extends Model
{
    use HasFactory;

    public function garbageType(): BelongsTo
    {
        return $this->belongsTo(GarbageType::class);
    }

    protected static function newFactory(): Factory
    {
        return GarbageCollectionFactory::new();
    }
}
