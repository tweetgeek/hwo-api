<?php

namespace App\Models;

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

    public const FIELD_YEAR = 'year';
    public const FIELD_CODE = 'code';
    public const FIELD_IS_PUBLIC = 'is_public';

    public $fillable = [
        self::FIELD_YEAR,
        self::FIELD_CODE,
        self::FIELD_IS_PUBLIC,
    ];

    public function garbageCollections(): HasMany
    {
        return $this->hasMany(GarbageCollection::class);
    }

    protected static function newFactory(): Factory
    {
        return GarbageScheduleFactory::new();
    }
}
