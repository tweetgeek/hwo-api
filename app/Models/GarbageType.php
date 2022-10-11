<?php

namespace App\Models;

use Database\Factories\GarbageTypeFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GarbageType extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function garbageCollections(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(GarbageCollection::class);
    }

    protected static function newFactory(): Factory
    {
        return GarbageTypeFactory::new();
    }
}
