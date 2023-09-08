<?php

namespace App\Dtos;

use App\Enums\DeviceType;
use Carbon\Carbon;

class DeviceDto
{
    public function __construct(
        public DeviceType $type,
        public string     $deviceId,
        public int        $userId,
        public ?bool      $isDevice = null,
        public ?string    $deviceType = null,
        public ?string    $modelName = null,
        public ?string    $osName = null,
        public ?string    $osVersion = null,
        public ?string    $pushToken = null,
        public ?Carbon    $lastSeen = null,
    ) {
    }

    public static function fromRequest($request): self
    {
        return new self(
            DeviceType::from($request['type']),
            $request['deviceId'],
            auth()->user()->id,
            $request['isDevice'] ?? null,
            $request['deviceType'] ?? null,
            $request['modelName'] ?? null,
            $request['osName'] ?? null,
            $request['osVersion'] ?? null,
            $request['pushToken'] ?? null,
            Carbon::now()
        );
    }
}
