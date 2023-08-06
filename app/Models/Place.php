<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const FIELD_ID = 'id';
    public const FIELD_NAME = 'name';

    protected $fillable = [
        self::FIELD_ID,
        self::FIELD_NAME,
    ];

    protected $keyType = 'string';
}
