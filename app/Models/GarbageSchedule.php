<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\GarbageScheduleFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class GarbageSchedule extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const FIELD_NAME = 'name';
    public const FIELD_CODE = 'code';

    protected $fillable = [
        self::FIELD_NAME,
        self::FIELD_CODE,
    ];

    public function garbageCollections(): HasMany
    {
        return $this->hasMany(GarbageCollection::class)->orderBy('date', 'asc');
    }

    public function availableGarbageCollections(): HasMany
    {
        return $this->hasMany(GarbageCollection::class)->where('date', '>=', Carbon::now())->orderBy('date');
    }

    protected static function newFactory(): Factory
    {
        return GarbageScheduleFactory::new();
    }
}
