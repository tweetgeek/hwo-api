<?php

namespace App\Actions\Auth;

use App\Dtos\DeviceDto;
use App\Models\UserDevice;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthorizeMobileDevice
{
    public function handle(Request $request): UserDevice
    {
        if (!$request->header(config('mobile.device_info_id_header'))) {
            throw ValidationException::withMessages([
                'device' => ['Invalid device!'],
            ]);
        }

        if (!$request->has(config('mobile.device_info_field'))) {
            throw ValidationException::withMessages([
                'device' => ['Invalid device!'],
            ]);
        }

        return $request->user()->authorizeDevice(DeviceDto::fromRequest($request->get(config('mobile.device_info_field'))));
    }
}
