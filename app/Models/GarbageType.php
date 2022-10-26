<?php

namespace App\Models;

use Database\Factories\GarbageTypeFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GarbageType extends Model
{
    use HasFactory;

    protected static function newFactory(): Factory
    {
        return GarbageTypeFactory::new();
    }
}
